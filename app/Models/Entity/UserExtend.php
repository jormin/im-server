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
 * 用户扩展信息表

 * @Entity()
 * @Table(name="user_extend")
 * @uses      UserExtend
 */
class UserExtend extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $userId 用户ID
     * @Column(name="user_id", type="integer")
     * @Required()
     */
    private $userId;

    /**
     * @var string $ueRegisterIp 注册IP
     * @Column(name="ue_register_ip", type="string", length=15)
     * @Required()
     */
    private $ueRegisterIp;

    /**
     * @var string $ueRegisterIpAddress 注册IP对应地区
     * @Column(name="ue_register_ip_address", type="string", length=100)
     * @Required()
     */
    private $ueRegisterIpAddress;

    /**
     * @var float $ueRegisterLongitude 注册GPS经度
     * @Column(name="ue_register_longitude", type="decimal", default=0)
     */
    private $ueRegisterLongitude;

    /**
     * @var float $ueRegisterLatitude 注册GPS纬度
     * @Column(name="ue_register_latitude", type="decimal", default=0)
     */
    private $ueRegisterLatitude;

    /**
     * @var int $ueSource 注册来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @Column(name="ue_source", type="tinyint")
     * @Required()
     */
    private $ueSource;

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
     * 用户ID
     * @param int $value
     * @return $this
     */
    public function setUserId(int $value): self
    {
        $this->userId = $value;

        return $this;
    }

    /**
     * 注册IP
     * @param string $value
     * @return $this
     */
    public function setUeRegisterIp(string $value): self
    {
        $this->ueRegisterIp = $value;

        return $this;
    }

    /**
     * 注册IP对应地区
     * @param string $value
     * @return $this
     */
    public function setUeRegisterIpAddress(string $value): self
    {
        $this->ueRegisterIpAddress = $value;

        return $this;
    }

    /**
     * 注册GPS经度
     * @param float $value
     * @return $this
     */
    public function setUeRegisterLongitude(float $value): self
    {
        $this->ueRegisterLongitude = $value;

        return $this;
    }

    /**
     * 注册GPS纬度
     * @param float $value
     * @return $this
     */
    public function setUeRegisterLatitude(float $value): self
    {
        $this->ueRegisterLatitude = $value;

        return $this;
    }

    /**
     * 注册来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @param int $value
     * @return $this
     */
    public function setUeSource(int $value): self
    {
        $this->ueSource = $value;

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
     * 用户ID
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 注册IP
     * @return string
     */
    public function getUeRegisterIp()
    {
        return $this->ueRegisterIp;
    }

    /**
     * 注册IP对应地区
     * @return string
     */
    public function getUeRegisterIpAddress()
    {
        return $this->ueRegisterIpAddress;
    }

    /**
     * 注册GPS经度
     * @return mixed
     */
    public function getUeRegisterLongitude()
    {
        return $this->ueRegisterLongitude;
    }

    /**
     * 注册GPS纬度
     * @return mixed
     */
    public function getUeRegisterLatitude()
    {
        return $this->ueRegisterLatitude;
    }

    /**
     * 注册来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @return int
     */
    public function getUeSource()
    {
        return $this->ueSource;
    }

}
