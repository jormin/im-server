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
 * 客服表

 * @Entity()
 * @Table(name="kefu")
 * @uses      Kefu
 */
class Kefu extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $kefuName 姓名
     * @Column(name="kefu_name", type="string", length=15)
     * @Required()
     */
    private $kefuName;

    /**
     * @var int $kefuGender 性别 0:未设定 1:男 2:女
     * @Column(name="kefu_gender", type="tinyint")
     * @Required()
     */
    private $kefuGender;

    /**
     * @var string $kefuPhone 注册手机号
     * @Column(name="kefu_phone", type="char", length=11)
     * @Required()
     */
    private $kefuPhone;

    /**
     * @var string $kefuPassword 密码
     * @Column(name="kefu_password", type="string", length=100)
     * @Required()
     */
    private $kefuPassword;

    /**
     * @var string $kefuPasswordSalt 密码加密盐
     * @Column(name="kefu_password_salt", type="char", length=10)
     * @Required()
     */
    private $kefuPasswordSalt;

    /**
     * @var int $kefuStatus 账号状态 0:未激活 1:启用 -1:禁用
     * @Column(name="kefu_status", type="tinyint", default=1)
     */
    private $kefuStatus;

    /**
     * @var int $createTime 注册时间
     * @Column(name="create_time", type="integer")
     * @Required()
     */
    private $createTime;

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
     * 姓名
     * @param string $value
     * @return $this
     */
    public function setKefuName(string $value): self
    {
        $this->kefuName = $value;

        return $this;
    }

    /**
     * 性别 0:未设定 1:男 2:女
     * @param int $value
     * @return $this
     */
    public function setKefuGender(int $value): self
    {
        $this->kefuGender = $value;

        return $this;
    }

    /**
     * 注册手机号
     * @param string $value
     * @return $this
     */
    public function setKefuPhone(string $value): self
    {
        $this->kefuPhone = $value;

        return $this;
    }

    /**
     * 密码
     * @param string $value
     * @return $this
     */
    public function setKefuPassword(string $value): self
    {
        $this->kefuPassword = $value;

        return $this;
    }

    /**
     * 密码加密盐
     * @param string $value
     * @return $this
     */
    public function setKefuPasswordSalt(string $value): self
    {
        $this->kefuPasswordSalt = $value;

        return $this;
    }

    /**
     * 账号状态 0:未激活 1:启用 -1:禁用
     * @param int $value
     * @return $this
     */
    public function setKefuStatus(int $value): self
    {
        $this->kefuStatus = $value;

        return $this;
    }

    /**
     * 注册时间
     * @param int $value
     * @return $this
     */
    public function setCreateTime(int $value): self
    {
        $this->createTime = $value;

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
     * 姓名
     * @return string
     */
    public function getKefuName()
    {
        return $this->kefuName;
    }

    /**
     * 性别 0:未设定 1:男 2:女
     * @return int
     */
    public function getKefuGender()
    {
        return $this->kefuGender;
    }

    /**
     * 注册手机号
     * @return string
     */
    public function getKefuPhone()
    {
        return $this->kefuPhone;
    }

    /**
     * 密码
     * @return string
     */
    public function getKefuPassword()
    {
        return $this->kefuPassword;
    }

    /**
     * 密码加密盐
     * @return string
     */
    public function getKefuPasswordSalt()
    {
        return $this->kefuPasswordSalt;
    }

    /**
     * 账号状态 0:未激活 1:启用 -1:禁用
     * @return mixed
     */
    public function getKefuStatus()
    {
        return $this->kefuStatus;
    }

    /**
     * 注册时间
     * @return int
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

}
