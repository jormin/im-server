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
 * 用户表

 * @Entity()
 * @Table(name="user")
 * @uses      User
 */
class User extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $userName 姓名
     * @Column(name="user_name", type="string", length=15)
     * @Required()
     */
    private $userName;

    /**
     * @var int $userGender 性别 0:未设定 1:男 2:女
     * @Column(name="user_gender", type="tinyint")
     * @Required()
     */
    private $userGender;

    /**
     * @var string $userAvatar 头像
     * @Column(name="user_avatar", type="string", length=200)
     * @Required()
     */
    private $userAvatar;

    /**
     * @var string $userPhone 注册手机号
     * @Column(name="user_phone", type="char", length=11)
     * @Required()
     */
    private $userPhone;

    /**
     * @var string $userPassword 密码
     * @Column(name="user_password", type="string", length=100)
     * @Required()
     */
    private $userPassword;

    /**
     * @var string $userPasswordSalt 密码加密盐
     * @Column(name="user_password_salt", type="char", length=10)
     * @Required()
     */
    private $userPasswordSalt;

    /**
     * @var int $userStatus 账号状态 0:未激活 1:启用 -1:禁用
     * @Column(name="user_status", type="tinyint", default=1)
     */
    private $userStatus;

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
    public function setUserName(string $value): self
    {
        $this->userName = $value;

        return $this;
    }

    /**
     * 性别 0:未设定 1:男 2:女
     * @param int $value
     * @return $this
     */
    public function setUserGender(int $value): self
    {
        $this->userGender = $value;

        return $this;
    }

    /**
     * 头像
     * @param string $userAvatar
     * @return $this
     */
    public function setUserAvatar(string $userAvatar)
    {
        $this->userAvatar = $userAvatar;

        return $this;
    }


    /**
     * 注册手机号
     * @param string $value
     * @return $this
     */
    public function setUserPhone(string $value): self
    {
        $this->userPhone = $value;

        return $this;
    }

    /**
     * 密码
     * @param string $value
     * @return $this
     */
    public function setUserPassword(string $value): self
    {
        $this->userPassword = $value;

        return $this;
    }

    /**
     * 密码加密盐
     * @param string $value
     * @return $this
     */
    public function setUserPasswordSalt(string $value): self
    {
        $this->userPasswordSalt = $value;

        return $this;
    }

    /**
     * 账号状态 0:未激活 1:启用 -1:禁用
     * @param int $value
     * @return $this
     */
    public function setUserStatus(int $value): self
    {
        $this->userStatus = $value;

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
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * 性别 0:未设定 1:男 2:女
     * @return int
     */
    public function getUserGender()
    {
        return $this->userGender;
    }

    /**
     * 头像
     * @return string
     */
    public function getUserAvatar(): string
    {
        return $this->userAvatar;
    }

    /**
     * 注册手机号
     * @return string
     */
    public function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * 密码
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * 密码加密盐
     * @return string
     */
    public function getUserPasswordSalt()
    {
        return $this->userPasswordSalt;
    }

    /**
     * 账号状态 0:未激活 1:启用 -1:禁用
     * @return mixed
     */
    public function getUserStatus()
    {
        return $this->userStatus;
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
