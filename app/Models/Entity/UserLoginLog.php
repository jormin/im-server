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
 * 用户登录日志表

 * @Entity()
 * @Table(name="im_user_login_log")
 * @uses      UserLoginLog
 */
class UserLoginLog extends Model
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
     * @var int $loginTime 登录时间
     * @Column(name="login_time", type="integer")
     * @Required()
     */
    private $loginTime;

    /**
     * @var string $ip IP
     * @Column(name="ip", type="string", length=15)
     * @Required()
     */
    private $ip;

    /**
     * @var string $ipAddress IP所在地区
     * @Column(name="ip_address", type="string", length=50)
     * @Required()
     */
    private $ipAddress;

    /**
     * @var float $longitude GPS经度
     * @Column(name="longitude", type="decimal", default=0)
     */
    private $longitude;

    /**
     * @var float $latitude GPS纬度
     * @Column(name="latitude", type="decimal", default=0)
     */
    private $latitude;

    /**
     * @var int $source 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
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
     * 登录时间
     * @param int $value
     * @return $this
     */
    public function setLoginTime(int $value): self
    {
        $this->loginTime = $value;

        return $this;
    }

    /**
     * IP
     * @param string $value
     * @return $this
     */
    public function setIp(string $value): self
    {
        $this->ip = $value;

        return $this;
    }

    /**
     * IP所在地区
     * @param string $value
     * @return $this
     */
    public function setIpAddress(string $value): self
    {
        $this->ipAddress = $value;

        return $this;
    }

    /**
     * GPS经度
     * @param float $value
     * @return $this
     */
    public function setLongitude(float $value): self
    {
        $this->longitude = $value;

        return $this;
    }

    /**
     * GPS纬度
     * @param float $value
     * @return $this
     */
    public function setLatitude(float $value): self
    {
        $this->latitude = $value;

        return $this;
    }

    /**
     * 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
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
     * 登录时间
     * @return int
     */
    public function getLoginTime()
    {
        return $this->loginTime;
    }

    /**
     * IP
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * IP所在地区
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * GPS经度
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * GPS纬度
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @return int
     */
    public function getSource()
    {
        return $this->source;
    }

}
