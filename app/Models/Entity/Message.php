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
 * @Table(name="im_message")
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
     * @var int $sessionId 会话ID
     * @Column(name="session_id", type="integer")
     * @Required()
     */
    private $sessionId;

    /**
     * @var int $senderId 发送方用户ID
     * @Column(name="sender_id", type="integer")
     * @Required()
     */
    private $senderId;

    /**
     * @var int $receiverType 接收方类型 0:用户 1:群组 2:聊天室
     * @Column(name="receiver_type", type="tinyint")
     * @Required()
     */
    private $receiverType;

    /**
     * @var int $receiverId 接收方对应ID
     * @Column(name="receiver_id", type="integer")
     * @Required()
     */
    private $receiverId;

    /**
     * @var int $messageTypeId 消息类型ID
     * @Column(name="message_type_id", type="smallint")
     * @Required()
     */
    private $messageTypeId;

    /**
     * @var int $attachmentId 附件ID
     * @Column(name="attachment_id", type="integer")
     * @Required()
     */
    private $attachmentId;

    /**
     * @var int $status 消息状态（0:已发送 1:已读(仅对用户间聊天有效) -1:已撤销）
     * @Column(name="status", type="tinyint", default=0)
     */
    private $status;

    /**
     * @var int $sendTime 发送时间
     * @Column(name="send_time", type="integer")
     * @Required()
     */
    private $sendTime;

    /**
     * @var int $readTime 阅读时间
     * @Column(name="read_time", type="integer")
     */
    private $readTime;

    /**
     * @var int $revokeTime 撤销时间
     * @Column(name="revoke_time", type="integer")
     * @Required()
     */
    private $revokeTime;

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
     * 会话ID
     * @param int $value
     * @return $this
     */
    public function setSessionId(int $value): self
    {
        $this->sessionId = $value;

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
     * 接收方类型 0:用户 1:群组 2:聊天室
     * @param int $value
     * @return $this
     */
    public function setReceiverType(int $value): self
    {
        $this->receiverType = $value;

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
     * 消息类型ID
     * @param int $value
     * @return $this
     */
    public function setMessageTypeId(int $value): self
    {
        $this->messageTypeId = $value;

        return $this;
    }

    /**
     * 附件ID
     * @param int $value
     * @return $this
     */
    public function setAttachmentId(int $value): self
    {
        $this->attachmentId = $value;

        return $this;
    }

    /**
     * 消息状态（0:已发送 1:已读(仅对用户间聊天有效) -1:已撤销）
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * 发送时间
     * @param int $value
     * @return $this
     */
    public function setSendTime(int $value): self
    {
        $this->sendTime = $value;

        return $this;
    }

    /**
     * 阅读时间
     * @param int $value
     * @return $this
     */
    public function setReadTime(int $value): self
    {
        $this->readTime = $value;

        return $this;
    }

    /**
     * 撤销时间
     * @param int $value
     * @return $this
     */
    public function setRevokeTime(int $value): self
    {
        $this->revokeTime = $value;

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
     * 会话ID
     * @return int
     */
    public function getSessionId()
    {
        return $this->sessionId;
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
     * 接收方类型 0:用户 1:群组 2:聊天室
     * @return int
     */
    public function getReceiverType()
    {
        return $this->receiverType;
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
     * 消息类型ID
     * @return int
     */
    public function getMessageTypeId()
    {
        return $this->messageTypeId;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 发送时间
     * @return int
     */
    public function getSendTime()
    {
        return $this->sendTime;
    }

    /**
     * 阅读时间
     * @return int
     */
    public function getReadTime()
    {
        return $this->readTime;
    }

    /**
     * 撤销时间
     * @return int
     */
    public function getRevokeTime()
    {
        return $this->revokeTime;
    }

}
