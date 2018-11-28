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
 * 客服登录日志表

 * @Entity()
 * @Table(name="kefu_login_log")
 * @uses      KefuLoginLog
 */
class KefuLoginLog extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $kefuId 客服ID
     * @Column(name="kefu_id", type="integer")
     * @Required()
     */
    private $kefuId;

    /**
     * @var int $kllLoginTime 登录时间
     * @Column(name="kll_login_time", type="integer")
     * @Required()
     */
    private $kllLoginTime;

    /**
     * @var string $kllIp IP
     * @Column(name="kll_ip", type="string", length=15)
     * @Required()
     */
    private $kllIp;

    /**
     * @var string $kllIpAddress IP所在地区
     * @Column(name="kll_ip_address", type="string", length=50)
     * @Required()
     */
    private $kllIpAddress;

    /**
     * @var float $kllLongitude GPS经度
     * @Column(name="kll_longitude", type="decimal", default=0)
     */
    private $kllLongitude;

    /**
     * @var float $kllLatitude GPS纬度
     * @Column(name="kll_latitude", type="decimal", default=0)
     */
    private $kllLatitude;

    /**
     * @var int $kllSource 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @Column(name="kll_source", type="tinyint")
     * @Required()
     */
    private $kllSource;

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
     * 客服ID
     * @param int $value
     * @return $this
     */
    public function setKefuId(int $value): self
    {
        $this->kefuId = $value;

        return $this;
    }

    /**
     * 登录时间
     * @param int $value
     * @return $this
     */
    public function setKllLoginTime(int $value): self
    {
        $this->kllLoginTime = $value;

        return $this;
    }

    /**
     * IP
     * @param string $value
     * @return $this
     */
    public function setKllIp(string $value): self
    {
        $this->kllIp = $value;

        return $this;
    }

    /**
     * IP所在地区
     * @param string $value
     * @return $this
     */
    public function setKllIpAddress(string $value): self
    {
        $this->kllIpAddress = $value;

        return $this;
    }

    /**
     * GPS经度
     * @param float $value
     * @return $this
     */
    public function setKllLongitude(float $value): self
    {
        $this->kllLongitude = $value;

        return $this;
    }

    /**
     * GPS纬度
     * @param float $value
     * @return $this
     */
    public function setKllLatitude(float $value): self
    {
        $this->kllLatitude = $value;

        return $this;
    }

    /**
     * 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @param int $value
     * @return $this
     */
    public function setKllSource(int $value): self
    {
        $this->kllSource = $value;

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
     * 客服ID
     * @return int
     */
    public function getKefuId()
    {
        return $this->kefuId;
    }

    /**
     * 登录时间
     * @return int
     */
    public function getKllLoginTime()
    {
        return $this->kllLoginTime;
    }

    /**
     * IP
     * @return string
     */
    public function getKllIp()
    {
        return $this->kllIp;
    }

    /**
     * IP所在地区
     * @return string
     */
    public function getKllIpAddress()
    {
        return $this->kllIpAddress;
    }

    /**
     * GPS经度
     * @return mixed
     */
    public function getKllLongitude()
    {
        return $this->kllLongitude;
    }

    /**
     * GPS纬度
     * @return mixed
     */
    public function getKllLatitude()
    {
        return $this->kllLatitude;
    }

    /**
     * 登录来源 0:手机网页 1:PC网页 2:Android客户端 3:IOS客户端 4:WindowsPC端 5:MAC端 6:接口调用
     * @return int
     */
    public function getKllSource()
    {
        return $this->kllSource;
    }

}
