<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/15
 * Time: 11:23 AM
 */

namespace App\Services;

use app\Common\CommonFunction;
use App\Models\Data\MessageData;
use App\Models\Entity\Kefu;
use App\Models\Entity\User;
use Jormin\IP\IP;
use Swoft\Bean\Annotation\Inject;
use Swoft\Rpc\Server\Bean\Annotation\Service;

/**
 * Class ImService
 * @package App\Services
 * @Service()
 */
class ImService extends BaseService
{
    /**
     * 接受者类型选项 0：用户 1：客服
     * @var array
     */
    private $receiverTypeOptions = [0, 1];

    /**
     * 消息类型选项 0：文本 1：图片 2：语音 3：视频 4：文件 5：位置
     * @var array
     */
    private $messageTypeOptions = [0, 1, 2, 3, 4, 5];

    /**
     * 消息类型选项 0：手机网页 1：PC网页 2：Android客户端 3：IOS客户端 4：WindowsPC客户端 5：Mac客户端 6：接口调用
     * @var array
     */
    private $sourceOptions = [0, 1, 2, 3, 4, 5, 6];

    /**
     * 用户池，用于记录当前连接用户
     * @var string
     */
    protected $userPoolKey = 'user_pool';

    /**
     * 用户FD池，用于记录当前连接用户FD信息
     * @var string
     */
    protected $userFdPoolKey = 'user_fd_pool';

    /**
     * 客服池，用于记录当前连接客服
     * @var string
     */
    protected $kefuPoolKey = 'kefu_pool';

    /**
     * 客服FD池，用于记录当前连接客服FD信息
     * @var string
     */
    protected $kefuFdPoolKey = 'kefu_fd_pool';

    /**
     * 用户等待队列，用于分配任务
     * @var string
     */
    protected $waitingUserQueueKey = 'waiting_user_queue';

    /**
     * 可分配客服池，用于分配任务
     * @var string
     */
    protected $distributeableKefuPoolKey = 'distributeable_kefu_pool';

    /**
     * 已分配客服用户数据
     * @var string
     */
    protected $distributedImSessionKey = 'distributed_im_session';

    /**
     * 客服接待成员缓存前缀
     * @var string
     */
    protected $kefuMembersKeyPrefix = 'kefu_members_';

    /**
     * 消息缓存Key
     * @var string
     */
    protected $messagesCacheKey = 'messages_';

    /**
     * 客服信息Key前缀
     * @var string
     */
    protected $kefuInfoCachePrefix = 'kefu_';

    /**
     * 用户信息Key前缀
     * @var string
     */
    protected $userInfoCachePrefix = 'user_';

    /**
     * 单客服最大接待阀值
     * @var int
     */
    protected $membersThreshold = 5;

    /**
     * @Inject()
     * @var MessageData
     */
    private $messageData;

    /**
     * 分配客服
     * @return array|bool
     */
    public function distribute()
    {
        // 检测当前可分配客服对象池数量
        $distributeableKefuAmount = $this->redis->zCard($this->distributeableKefuPoolKey);
        if ($distributeableKefuAmount === 0) {
            return false;
        }
        // 从当前用户等待队列中读取用户ID
        $result = $this->redis->zRange($this->waitingUserQueueKey, 0, -1);
        if (!$result) {
            return false;
        }
        $userId = $result[0];
        // 读取当前可分配客服池中优先级最高的客服
        $result = $this->redis->zRange($this->distributeableKefuPoolKey, 0, 0);
        if (!$result) {
            return false;
        }
        $kefuId = $result[0];
        $user = $this->getUserById($userId);
        $kefu = $this->getKefuById($kefuId);
        $kefuMembersKey = $this->kefuMembersKeyPrefix . $kefuId;
        // 分配用户
        $this->redis->sAdd($kefuMembersKey, $userId);
        // 检测当前客服的已分配用户数是否已经达到阀值，达到阀值后需要从可分配客服对象池移除
        $kefuMembersAmount = $this->redis->sCard($kefuMembersKey);
        if ($kefuMembersAmount === $this->membersThreshold) {
            $this->redis->zRem($this->distributeableKefuPoolKey, $kefuId);
        } else {
            $this->redis->zIncrBy($this->distributeableKefuPoolKey, 1, $kefuId);
        }
        // 记录已分配客服和用户
        $this->redis->zAdd($this->distributedImSessionKey, microtime(true), $kefuId . '-' . $userId);
        // 发送消息
        $userFd = $this->redis->zScore($this->userPoolKey, $userId);
        $kefuFd = $this->redis->zScore($this->kefuPoolKey, $kefuId);
        // 通知用户分配成功
        $userMessage = '已分配'.$kefu->getKefuName();
        $this->sendDistributeMessage($userFd, $userMessage, ['id' => $kefuId, 'name'=>$kefu->getKefuName()]);
        // 通知客服分配成功
        $kefuMessage = '已分配用户' . $user->getUserName();
        $this->sendDistributeMessage($kefuFd, $kefuMessage, ['id' => $userId, 'name'=>$user->getUserName(), 'avatar'=>$user->getUserAvatar()]);
        // 从等待池中移除该用户
        $this->redis->zRem($this->waitingUserQueueKey, $userId);
        // 返回分配的客服ID
        return array($kefuId, $userId);
    }

    /**
     * 缓存聊天消息
     * @param int $kefuId
     * @param int $userId
     * @param string $content
     * @param int $receiverType
     * @param int $messageType
     * @param int $attachmentId
     * @param int $source
     * @return bool|null
     */
    public function cacheMessage(int $kefuId, int $userId, string $content, int $receiverType, int $messageType, int $attachmentId = null, int $source = 0)
    {
        if (!in_array($receiverType, $this->receiverTypeOptions)) {
            return false;
        }
        if (!in_array($messageType, $this->messageTypeOptions)) {
            return false;
        }
        if (!in_array($source, $this->sourceOptions)) {
            return false;
        }
        if (in_array($messageType, [0, 5])) {
            $attachmentId = null;
        } else {
            if (!$attachmentId) {
                return false;
            }
        }
        $ip = CommonFunction::getClientIP();
        $ipAddress = IP::ip2addr($ip, true, '');
        list($senderId, $receiverId) = $receiverType === 0 ? array($kefuId, $userId) : array($userId, $kefuId);
        $data = [
            'senderId' => $senderId,
            'receiverId' => $receiverId,
            'mcContent' => $content,
            'messageReceiverType' => $receiverType,
            'messageType' => $messageType,
            'attachmentId' => $attachmentId,
            'messageSendDate' => date('Y-m-d'),
            'messageSendTime' => time(),
            'meSenderIp' => $ip,
            'meSenderIpAddress' => $ipAddress,
            'meSource' => $source,
            'messageRevokeTime' => 0
        ];
        $this->redis->rPush($this->messagesCacheKey, json_encode($data));
        return null;
    }

    /**
     * 数据持久化
     * @return bool
     */
    public function persistence()
    {
        $data = $this->redis->lPop($this->messagesCacheKey);
        if (!$data) {
            return false;
        }
        $data = json_decode($data, true);
        $result = $this->messageData->saveMessage($data);
        if ($result === false) {
            $this->redis->rPush($this->messagesCacheKey, json_encode($data));
        }
        return $result;
    }

    /**
     * 通过FD从缓存中反查用户信息
     * @param $fd
     * @return User
     */
    public function getUserByFd($fd){
        $userId = $this->redis->zScore($this->userFdPoolKey, $fd);
        $user = $this->getUserById($userId);
        return $user;
    }

    /**
     * 通过客服ID从缓存中查询用户信息
     * @param $userId
     * @return User
     */
    public function getUserById($userId){
        $user = unserialize($this->redis->get($this->userInfoCachePrefix . $userId));
        return $user;
    }

    /**
     * 通过FD从缓存中反查客服信息
     * @param $fd
     * @return Kefu
     */
    public function getKefuByFd($fd){
        $kefuId = $this->redis->zScore($this->kefuFdPoolKey, $fd);
        $kefu = $this->getKefuById($kefuId);
        return $kefu;
    }

    /**
     * 通过客服ID从缓存中查询客服信息
     * @param $kefuId
     * @return Kefu
     */
    public function getKefuById($kefuId){
        $kefu = unserialize($this->redis->get($this->kefuInfoCachePrefix . $kefuId));
        return $kefu;
    }

}
