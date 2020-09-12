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
 * @Table(name="im_user_extend")
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
     * @var string $registerIp 注册IP
     * @Column(name="register_ip", type="string", length=15)
     * @Required()
     */
    private $registerIp;

    /**
     * @var string $registerIpAddress 注册IP对应地区
     * @Column(name="register_ip_address", type="string", length=100)
     * @Required()
     */
    private $registerIpAddress;

    /**
     * @var float $registerLongitude 注册GPS经度
     * @Column(name="register_longitude", type="decimal", default=0)
     */
    private $registerLongitude;

    /**
     * @var float $registerLatitude 注册GPS纬度
     * @Column(name="register_latitude", type="decimal", default=0)
     */
    private $registerLatitude;

    /**
     * @var int $source 注册来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
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
    public function setRegisterIp(string $value): self
    {
        $this->registerIp = $value;

        return $this;
    }

    /**
     * 注册IP对应地区
     * @param string $value
     * @return $this
     */
    public function setRegisterIpAddress(string $value): self
    {
        $this->registerIpAddress = $value;

        return $this;
    }

    /**
     * 注册GPS经度
     * @param float $value
     * @return $this
     */
    public function setRegisterLongitude(float $value): self
    {
        $this->registerLongitude = $value;

        return $this;
    }

    /**
     * 注册GPS纬度
     * @param float $value
     * @return $this
     */
    public function setRegisterLatitude(float $value): self
    {
        $this->registerLatitude = $value;

        return $this;
    }

    /**
     * 注册来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
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
    public function getRegisterIp()
    {
        return $this->registerIp;
    }

    /**
     * 注册IP对应地区
     * @return string
     */
    public function getRegisterIpAddress()
    {
        return $this->registerIpAddress;
    }

    /**
     * 注册GPS经度
     * @return mixed
     */
    public function getRegisterLongitude()
    {
        return $this->registerLongitude;
    }

    /**
     * 注册GPS纬度
     * @return mixed
     */
    public function getRegisterLatitude()
    {
        return $this->registerLatitude;
    }

    /**
     * 注册来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @return int
     */
    public function getSource()
    {
        return $this->source;
    }

}
