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
 * @Table(name="user_login_log")
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
     * @var int $ullLoginTime 登录时间
     * @Column(name="ull_login_time", type="integer")
     * @Required()
     */
    private $ullLoginTime;

    /**
     * @var string $ullIp IP
     * @Column(name="ull_ip", type="string", length=15)
     * @Required()
     */
    private $ullIp;

    /**
     * @var string $ullIpAddress IP所在地区
     * @Column(name="ull_ip_address", type="string", length=50)
     * @Required()
     */
    private $ullIpAddress;

    /**
     * @var float $ullLongitude GPS经度
     * @Column(name="ull_longitude", type="decimal", default=0)
     */
    private $ullLongitude;

    /**
     * @var float $ullLatitude GPS纬度
     * @Column(name="ull_latitude", type="decimal", default=0)
     */
    private $ullLatitude;

    /**
     * @var int $ullSource 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @Column(name="ull_source", type="tinyint")
     * @Required()
     */
    private $ullSource;

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
    public function setUllLoginTime(int $value): self
    {
        $this->ullLoginTime = $value;

        return $this;
    }

    /**
     * IP
     * @param string $value
     * @return $this
     */
    public function setUllIp(string $value): self
    {
        $this->ullIp = $value;

        return $this;
    }

    /**
     * IP所在地区
     * @param string $value
     * @return $this
     */
    public function setUllIpAddress(string $value): self
    {
        $this->ullIpAddress = $value;

        return $this;
    }

    /**
     * GPS经度
     * @param float $value
     * @return $this
     */
    public function setUllLongitude(float $value): self
    {
        $this->ullLongitude = $value;

        return $this;
    }

    /**
     * GPS纬度
     * @param float $value
     * @return $this
     */
    public function setUllLatitude(float $value): self
    {
        $this->ullLatitude = $value;

        return $this;
    }

    /**
     * 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @param int $value
     * @return $this
     */
    public function setUllSource(int $value): self
    {
        $this->ullSource = $value;

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
    public function getUllLoginTime()
    {
        return $this->ullLoginTime;
    }

    /**
     * IP
     * @return string
     */
    public function getUllIp()
    {
        return $this->ullIp;
    }

    /**
     * IP所在地区
     * @return string
     */
    public function getUllIpAddress()
    {
        return $this->ullIpAddress;
    }

    /**
     * GPS经度
     * @return mixed
     */
    public function getUllLongitude()
    {
        return $this->ullLongitude;
    }

    /**
     * GPS纬度
     * @return mixed
     */
    public function getUllLatitude()
    {
        return $this->ullLatitude;
    }

    /**
     * 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @return int
     */
    public function getUllSource()
    {
        return $this->ullSource;
    }

}
