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
 * 消息扩展信息表

 * @Entity()
 * @Table(name="im_message_extend")
 * @uses      MessageExtend
 */
class MessageExtend extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $messageId 消息ID
     * @Column(name="message_id", type="integer")
     * @Required()
     */
    private $messageId;

    /**
     * @var string $senderIp 发送方IP
     * @Column(name="sender_ip", type="string", length=15)
     * @Required()
     */
    private $senderIp;

    /**
     * @var string $senderIpAddress 发送方IP对应地区
     * @Column(name="sender_ip_address", type="string", length=100)
     * @Required()
     */
    private $senderIpAddress;

    /**
     * @var float $senderLongitude 发送方GPS经度
     * @Column(name="sender_longitude", type="decimal", default=0)
     */
    private $senderLongitude;

    /**
     * @var float $senderLatitude 发送方GPS纬度
     * @Column(name="sender_latitude", type="decimal", default=0)
     */
    private $senderLatitude;

    /**
     * @var int $source 消息来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @Column(name="source", type="tinyint")
     * @Required()
     */
    private $source;

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
     * 消息ID
     * @param int $value
     * @return $this
     */
    public function setMessageId(int $value): self
    {
        $this->messageId = $value;

        return $this;
    }

    /**
     * 发送方IP
     * @param string $value
     * @return $this
     */
    public function setSenderIp(string $value): self
    {
        $this->senderIp = $value;

        return $this;
    }

    /**
     * 发送方IP对应地区
     * @param string $value
     * @return $this
     */
    public function setSenderIpAddress(string $value): self
    {
        $this->senderIpAddress = $value;

        return $this;
    }

    /**
     * 发送方GPS经度
     * @param float $value
     * @return $this
     */
    public function setSenderLongitude(float $value): self
    {
        $this->senderLongitude = $value;

        return $this;
    }

    /**
     * 发送方GPS纬度
     * @param float $value
     * @return $this
     */
    public function setSenderLatitude(float $value): self
    {
        $this->senderLatitude = $value;

        return $this;
    }

    /**
     * 消息来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @param int $value
     * @return $this
     */
    public function setSource(int $value): self
    {
        $this->source = $value;

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
     * 消息ID
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * 发送方IP
     * @return string
     */
    public function getSenderIp()
    {
        return $this->senderIp;
    }

    /**
     * 发送方IP对应地区
     * @return string
     */
    public function getSenderIpAddress()
    {
        return $this->senderIpAddress;
    }

    /**
     * 发送方GPS经度
     * @return mixed
     */
    public function getSenderLongitude()
    {
        return $this->senderLongitude;
    }

    /**
     * 发送方GPS纬度
     * @return mixed
     */
    public function getSenderLatitude()
    {
        return $this->senderLatitude;
    }

    /**
     * 消息来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @return int
     */
    public function getSource()
    {
        return $this->source;
    }

}
