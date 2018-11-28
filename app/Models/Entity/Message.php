<?php
namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * 消息表

 * @Entity()
 * @Table(name="message")
 * @uses      Message
 */
class Message extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $senderId 发送方用户ID
     * @Column(name="sender_id", type="integer")
     * @Required()
     */
    private $senderId;

    /**
     * @var int $messageReceiverType 接收方类型 0:用户 1:客服
     * @Column(name="message_receiver_type", type="tinyint")
     * @Required()
     */
    private $messageReceiverType;

    /**
     * @var int $receiverId 接收方对应ID
     * @Column(name="receiver_id", type="integer")
     * @Required()
     */
    private $receiverId;

    /**
     * @var int $messageType 消息类型（0:文本 1:图片 2:语音 3:视频 4:文件 5:位置)
     * @Column(name="message_type", type="tinyint")
     * @Required()
     */
    private $messageType;

    /**
     * @var null|int $attachmentId 附件ID
     * @Column(name="attachment_id", type="integer")
     */
    private $attachmentId;

    /**
     * @var int $messageStatus 消息状态（0:已发送 1:已读(仅对用户间聊天有效) -1:已撤销）
     * @Column(name="message_status", type="tinyint", default=0)
     */
    private $messageStatus;

    /**
     * @var string $messageSendDate 发送日期
     * @Column(name="message_send_date", type="char", length=10)
     * @Required()
     */
    private $messageSendDate;

    /**
     * @var int $messageSendTime 发送时间
     * @Column(name="message_send_time", type="integer")
     * @Required()
     */
    private $messageSendTime;

    /**
     * @var int $messageRevokeTime 撤销时间
     * @Column(name="message_revoke_time", type="integer")
     * @Required()
     */
    private $messageRevokeTime;

    /**
     * ID
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 发送方用户ID
     * @param int $value
     * @return $this
     */
    public function setSenderId(int $value): self
    {
        $this->senderId = $value;

        return $this;
    }

    /**
     * 接收方类型 0:用户 1:客服
     * @param int $value
     * @return $this
     */
    public function setMessageReceiverType(int $value): self
    {
        $this->messageReceiverType = $value;

        return $this;
    }

    /**
     * 接收方对应ID
     * @param int $value
     * @return $this
     */
    public function setReceiverId(int $value): self
    {
        $this->receiverId = $value;

        return $this;
    }

    /**
     * 消息类型（0:文本 1:图片 2:语音 3:视频 4:文件 5:位置)
     * @param int $value
     * @return $this
     */
    public function setMessageType(int $value): self
    {
        $this->messageType = $value;

        return $this;
    }

    /**
     * @param int|null $attachmentId
     */
    public function setAttachmentId(?int $attachmentId): void
    {
        $this->attachmentId = $attachmentId;
    }

    /**
     * 消息状态（0:已发送 1:已读(仅对用户间聊天有效) -1:已撤销）
     * @param int $value
     * @return $this
     */
    public function setMessageStatus(int $value): self
    {
        $this->messageStatus = $value;

        return $this;
    }

    /**
     * 发送日期
     * @param string $value
     * @return $this
     */
    public function setMessageSendDate(string $value): self
    {
        $this->messageSendDate = $value;

        return $this;
    }

    /**
     * 发送时间
     * @param int $value
     * @return $this
     */
    public function setMessageSendTime(int $value): self
    {
        $this->messageSendTime = $value;

        return $this;
    }

    /**
     * 撤销时间
     * @param int $value
     * @return $this
     */
    public function setMessageRevokeTime(int $value): self
    {
        $this->messageRevokeTime = $value;

        return $this;
    }

    /**
     * ID
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 发送方用户ID
     * @return int
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * 接收方类型 0:用户 1:客服
     * @return int
     */
    public function getMessageReceiverType()
    {
        return $this->messageReceiverType;
    }

    /**
     * 接收方对应ID
     * @return int
     */
    public function getReceiverId()
    {
        return $this->receiverId;
    }

    /**
     * 消息类型（0:文本 1:图片 2:语音 3:视频 4:文件 5:位置)
     * @return int
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * 附件ID
     * @return int
     */
    public function getAttachmentId()
    {
        return $this->attachmentId;
    }

    /**
     * 消息状态（0:已发送 1:已读(仅对用户间聊天有效) -1:已撤销）
     * @return int
     */
    public function getMessageStatus()
    {
        return $this->messageStatus;
    }

    /**
     * 发送日期
     * @return string
     */
    public function getMessageSendDate()
    {
        return $this->messageSendDate;
    }

    /**
     * 发送时间
     * @return int
     */
    public function getMessageSendTime()
    {
        return $this->messageSendTime;
    }

    /**
     * 撤销时间
     * @return int
     */
    public function getMessageRevokeTime()
    {
        return $this->messageRevokeTime;
    }

}
