<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/14
 * Time: 2:31 PM
 */

namespace App\Services;


use App\Lib\KefuInterface;
use App\Models\Entity\Kefu;
use Swoft\Rpc\Server\Bean\Annotation\Service;

/**
 * Class KefuService
 * @package App\Services
 * @Service()
 */
class KefuService extends ImService implements KefuInterface
{

    /**
     * 客服上线
     * @param Kefu $kefu
     * @param int $fd
     * @return null
     */
    public function online(Kefu $kefu, int $fd)
    {
        $kefuId = $kefu->getId();
        // 判断当前客服是否已经上线，如果当前已上线，需要清掉之前的信息
        $lastIndex = $this->redis->zRank($this->kefuFdPoolKey, $kefuId);
        if(!is_null($lastIndex)){
            // 从客服池中移除该客服信息
            $this->redis->zRem($this->kefuPoolKey, $kefuId);
            // 从客服FD池中移除该客服信息
            $this->redis->zRemRangeByRank($this->kefuFdPoolKey, $lastIndex, $lastIndex);
            // 从可分配客服池中移除该客服信息
            $this->redis->zRem($this->distributeableKefuPoolKey, $kefuId);
            // 清掉之前的客服信息缓存
            $this->redis->delete($this->kefuInfoCachePrefix . $kefuId);
        }
        // 将当前客服添加到客服池中，并通过分数绑定客服ID和FD
        $this->redis->zAdd($this->kefuPoolKey, $fd, $kefuId);
        // 将当前客服添加到客服FD池中，并通过分数绑定客服ID和FD
        $this->redis->zAdd($this->kefuFdPoolKey, $kefuId, $fd);
        // 将当前客服添加到可分配客服池中
        $this->redis->zAdd($this->distributeableKefuPoolKey, 0, $kefuId);
        // 将客服信息存入缓存
        $this->redis->set($this->kefuInfoCachePrefix . $kefuId, serialize($kefu));
        return null;
    }

    /**
     * 客服下线
     * @param Kefu $kefu
     * @param int $fd
     * @return null
     */
    public function offline(Kefu $kefu, int $fd)
    {
        // 将当前客服从客服池中移除
        $this->redis->zRem($this->kefuPoolKey, $kefu->getId());
        // 将当前客服从客服FD池中移除
        $this->redis->zRem($this->kefuFdPoolKey, $fd);
        // 将当前客服从可分配客服池中移除
        $this->redis->zRem($this->distributeableKefuPoolKey, $kefu->getId());
        // 将客服信息从缓存中移除
        $this->redis->delete($this->kefuInfoCachePrefix . $kefu->getId());
        // 释放当前客服正在服务的用户，并将这些用户加入到等待池的前端
        $sessions = $this->redis->zRange($this->distributedImSessionKey, 0, -1);
        foreach ($sessions as $session) {
            if (!preg_match("/^" . $kefu->getId() . "-/", $session)) {
                continue;
            }
            $sessionArr = explode('-', $session);
            $userId = $sessionArr[1];
            $this->redis->zAdd($this->waitingUserQueueKey, 0, $userId);
            $this->redis->zRem($this->distributedImSessionKey, $session);
            $userFd = $this->redis->zScore($this->userPoolKey, $userId);
            $message = '【'.$kefu->getKefuName().'】暂时离开了，正在为您安排新的客服，请耐心等待～';
            $this->sendGMOfflineMessage($userFd, $message, ['id'=>$kefu->getId(), 'name'=>$kefu->getKefuName()]);
        }
        return null;
    }

    /**
     * 客服发送消息
     * @param Kefu $kefu
     * @param int $fd
     * @param array $data
     * @return null
     */
    public function sendMessage(Kefu $kefu, int $fd, array $data)
    {
        $userId = $data['receiver']['id'];
        $userFd = $this->redis->zScore($this->userPoolKey, $userId);
        $this->sendIMMessage($userFd, 0, $data['content'], 0, ['id' => $kefu->getId(), 'name' => $kefu->getKefuName()]);
        $this->cacheMessage($kefu->getId(), $userId, $data['content'], 0, $data['messageType'], null, 1);
        return null;
    }

}
