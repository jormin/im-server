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
 * @Table(name="message_extend")
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
     * @var string $meSenderIp 发送方IP
     * @Column(name="me_sender_ip", type="string", length=15)
     * @Required()
     */
    private $meSenderIp;

    /**
     * @var string $meSenderIpAddress 发送方IP对应地区
     * @Column(name="me_sender_ip_address", type="string", length=100)
     * @Required()
     */
    private $meSenderIpAddress;

    /**
     * @var float $meSenderLongitude 发送方GPS经度
     * @Column(name="me_sender_longitude", type="decimal", default=0)
     */
    private $meSenderLongitude;

    /**
     * @var float $meSenderLatitude 发送方GPS纬度
     * @Column(name="me_sender_latitude", type="decimal", default=0)
     */
    private $meSenderLatitude;

    /**
     * @var int $meSource 消息来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:Mac客户端 6:接口调用
     * @Column(name="me_source", type="tinyint")
     * @Required()
     */
    private $meSource;

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
    public function setMeSenderIp(string $value): self
    {
        $this->meSenderIp = $value;

        return $this;
    }

    /**
     * 发送方IP对应地区
     * @param string $value
     * @return $this
     */
    public function setMeSenderIpAddress(string $value): self
    {
        $this->meSenderIpAddress = $value;

        return $this;
    }

    /**
     * 发送方GPS经度
     * @param float $value
     * @return $this
     */
    public function setMeSenderLongitude(float $value): self
    {
        $this->meSenderLongitude = $value;

        return $this;
    }

    /**
     * 发送方GPS纬度
     * @param float $value
     * @return $this
     */
    public function setMeSenderLatitude(float $value): self
    {
        $this->meSenderLatitude = $value;

        return $this;
    }

    /**
     * 消息来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @param int $value
     * @return $this
     */
    public function setMeSource(int $value): self
    {
        $this->meSource = $value;

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
    public function getMeSenderIp()
    {
        return $this->meSenderIp;
    }

    /**
     * 发送方IP对应地区
     * @return string
     */
    public function getMeSenderIpAddress()
    {
        return $this->meSenderIpAddress;
    }

    /**
     * 发送方GPS经度
     * @return mixed
     */
    public function getMeSenderLongitude()
    {
        return $this->meSenderLongitude;
    }

    /**
     * 发送方GPS纬度
     * @return mixed
     */
    public function getMeSenderLatitude()
    {
        return $this->meSenderLatitude;
    }

    /**
     * 消息来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @return int
     */
    public function getMeSource()
    {
        return $this->meSource;
    }

}
