<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/14
 * Time: 2:31 PM
 */

namespace App\Services;


use App\Lib\UserInterface;
use App\Models\Entity\User;
use Swoft\Rpc\Server\Bean\Annotation\Service;

/**
 * Class UserService
 * @package App\Services
 * @Service()
 */
class UserService extends ImService implements UserInterface
{

    /**
     * 用户上线
     * @param User $user
     * @param int $fd
     * @return null
     */
    public function online(User $user, int $fd)
    {
        $userId = $user->getId();
        // 判断当前用户是否已经上线，如果当前已上线，需要清掉之前的信息
        $lastIndex = $this->redis->zRank($this->userFdPoolKey, $userId);
        if(!is_null($lastIndex)){
            // 从用户池中移除该用户信息
            $this->redis->zRem($this->userPoolKey, $userId);
            // 从用户FD池中移除该用户信息
            $this->redis->zRemRangeByRank($this->userFdPoolKey, $lastIndex, $lastIndex);
            // 从可分配用户池中移除该用户信息
            $this->redis->zRem($this->waitingUserQueueKey, $userId);
            // 清掉之前的用户信息缓存
            $this->redis->delete($this->userInfoCachePrefix . $userId);
        }
        // 将当前用户添加到用户池中，并通过分数绑定用户ID和FD
        $this->redis->zAdd($this->userPoolKey, $fd, $userId);
        // 将当前用户添加到用户FD池中，并通过分数绑定用户ID和FD
        $this->redis->zAdd($this->userFdPoolKey, $userId, $fd);
        // 将当前用户添加到等待队列中
        $this->redis->zAdd($this->waitingUserQueueKey, microtime(true), $userId);
        // 将用户信息存入缓存
        $this->redis->set($this->userInfoCachePrefix . $userId, serialize($user));
        return null;
    }

    /**
     * 用户下线
     * @param User $user
     * @param int $fd
     * @return null
     */
    public function offline(User $user, int $fd)
    {
        // 将当前用户从用户池中移除
        $this->redis->zRem($this->userPoolKey, $user->getId());
        // 将当前用户从用户FD池中移除
        $this->redis->zRem($this->userFdPoolKey, $fd);
        // 将用户信息从缓存中移除
        $this->redis->delete($this->userInfoCachePrefix . $user->getId());
        // 释放当前服务用户该用户的客服，并将这些用户加入到等待池的前端
        $sessions = $this->redis->zRange($this->distributedImSessionKey, 0, -1);
        // 此处使用循环处理，但实际上最多只会找到一个会话
        foreach ($sessions as $session){
            if(!preg_match("/-".$user->getId()."$/",$session)){
                continue;
            }
            $sessionArr = explode('-', $session);
            $kefuId = $sessionArr[0];
            $kefuMembersKey = $this->kefuMembersKeyPrefix . $kefuId;
            // 将当前用户从所属客服的服务列表中移除
            $this->redis->sRem($kefuMembersKey, $user->getId());
            // 检测当前客服是否在可分配名单中，如果不在则添加进去，如果在则分数减1
            $distributeableIndex = $this->redis->zrank($this->distributeableKefuPoolKey, $kefuId);
            if (is_null($distributeableIndex)) {
                $kefuMembersAmount = $this->redis->sCard($kefuMembersKey);
                $this->redis->zAdd($this->distributeableKefuPoolKey, $kefuMembersAmount, $kefuId);
            } else {
                $this->redis->zIncrBy($this->distributeableKefuPoolKey, -1, $kefuId);
            }
            // 移除当前会话
            $this->redis->zRem($this->distributedImSessionKey, $session);
            $kefuFd = $this->redis->zScore($this->kefuPoolKey, $kefuId);
            $message = '用户【'.$user->getUserName().'】已下线';
            $this->sendGMOfflineMessage($kefuFd, $message, ['id'=>$user->getId(), 'name'=>$user->getUserName()]);
        }
        return null;
    }

    /**
     * 用户排队
     * @param int $fd
     * @return null
     */
    public function waiting(int $fd)
    {
        // 判断当前排队人数
        $waitingUsergAmount = $this->redis->zCard($this->waitingUserQueueKey);
        if ($waitingUsergAmount === 0) {
            $message = '当前没有排队人数，正在为您分配客服，请稍后～';
        } else {
            $message = '当前排队人数' . $waitingUsergAmount . '人，将很快为您分配客服，请稍后～';
        }
        $this->sendGMMessage($fd, 1, $message);
        return null;
    }

    /**
     * 用户发送消息
     * @param User $user
     * @param int $fd
     * @param array $data
     * @return null
     */
    public function sendMessage(User $user, int $fd, array $data)
    {
        $kefuId = $data['receiver']['id'];
        $kefuFd = $this->redis->zScore($this->kefuPoolKey, $kefuId);
        $this->sendIMMessage($kefuFd, 0, $data['content'], 0, ['id' => $user->getId(), 'name' => $user->getUserName()]);
        $this->cacheMessage($kefuId, $user->getId(), $data['content'], 1, $data['messageType'], null, 1);
        return null;
    }

}
