<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/16
 * Time: 12:50 PM
 */

namespace App\Traits;

trait SenderTrait
{

    /**
     * 单发消息
     * @param int $fd
     * @param int $type 0:GM 1:IM
     * @param int $subType
     * @param string $content
     * @param int $messageType 0:文本 1:图片 2:语音 3:视频 4:文件 5:位置
     * @param array $extData
     * @param int $senderFd
     */
    protected function sendTo(int $fd, int $type, int $subType, string $content, int $messageType = 0, array $extData = [], int $senderFd = 0)
    {
        $data = [
            'type' => $type,
            'subType' => $subType,
            'messageType' => $messageType,
            'content' => $content
        ];
        if (count($extData)) {
            $data = array_merge($data, $extData);
        }
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        \Swoft::$server->sendTo($fd, $data, $senderFd);
    }

    /**
     * 发送系统消息
     * @param int $fd
     * @param int $subType 0:欢迎消息 1:常规消息 2:分配成功通知 3:系统提示消息(不显示) 4:用户/客服下线
     * @param string $content
     * @param int $messageType 0:文本 1:图片 2:语音 3:视频 4:文件 5:位置
     * @param array $extData
     */
    protected function sendGMMessage(int $fd, int $subType, string $content, int $messageType = 0, array $extData = [])
    {
        $this->sendTo($fd, 0, $subType, $content, $messageType, $extData);
    }

    /**
     * 发送欢迎消息
     * @param int $fd
     * @param string $content
     * @param array $identityInfo
     */
    protected function sendWelcomeMessage(int $fd, string $content, array $identityInfo = [])
    {
        $extData = [
            'identityInfo' => $identityInfo
        ];
        $this->sendGMMessage($fd, 0, $content, 0, $extData);
    }

    /**
     * 发送常规GM消息
     * @param int $fd
     * @param string $content
     */
    protected function sendGMCommonMessage(int $fd, string $content)
    {
        $this->sendGMMessage($fd, 1, $content, 0);
    }

    /**
     * 发送分配成功消息
     * @param int $fd
     * @param string $content
     * @param array $session
     */
    protected function sendDistributeMessage(int $fd, string $content, array $session = [])
    {
        $extData = [
            'session' => $session
        ];
        $this->sendGMMessage($fd, 2, $content, 0, $extData);
    }

    /**
     * 发送用户/客服下线消息
     * @param int $fd
     * @param string $content
     * @param array $session
     */
    protected function sendGMOfflineMessage(int $fd, string $content, array $session = [])
    {
        $extData = [
            'session' => $session
        ];
        $this->sendGMMessage($fd, 4, $content, 0, $extData);
    }

    /**
     * 发送聊天消息
     * @param int $fd
     * @param int $subType 0:常规聊天消息
     * @param string $content
     * @param int $messageType 0:文本 1:图片 2:语音 3:视频 4:文件 5:位置
     * @param array $session
     * @param array $extData
     */
    protected function sendIMMessage(int $fd, int $subType, string $content, int $messageType = 0, array $session = [], array $extData = [])
    {
        $extData['session'] = $session;
        $this->sendTo($fd, 1, $subType, $content, $messageType, $extData);
    }

}
