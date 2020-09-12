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
 * @Table(name="im_user")
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
     * @var string $nickname 昵称
     * @Column(name="nickname", type="string", length=15)
     * @Required()
     */
    private $nickname;

    /**
     * @var int $gender 性别 0:未设定 1:男 2:女
     * @Column(name="gender", type="tinyint", default=0)
     */
    private $gender;

    /**
     * @var string $avatar 用户头像
     * @Column(name="avatar", type="string", length=255, default="")
     */
    private $avatar;

    /**
     * @var string $phone 注册手机号
     * @Column(name="phone", type="char", length=11)
     * @Required()
     */
    private $phone;

    /**
     * @var string $password 密码
     * @Column(name="password", type="string", length=100)
     * @Required()
     */
    private $password;

    /**
     * @var string $salt 密码加密盐
     * @Column(name="salt", type="char", length=10)
     * @Required()
     */
    private $salt;

    /**
     * @var int $status 账号状态 0:未激活 1:启用 -1:禁用
     * @Column(name="status", type="tinyint", default=1)
     */
    private $status;

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
     * 昵称
     * @param string $value
     * @return $this
     */
    public function setNickname(string $value): self
    {
        $this->nickname = $value;

        return $this;
    }

    /**
     * 性别 0:未设定 1:男 2:女
     * @param int $value
     * @return $this
     */
    public function setGender(int $value): self
    {
        $this->gender = $value;

        return $this;
    }

    /**
     * 用户头像
     * @param string $value
     * @return $this
     */
    public function setAvatar(string $value): self
    {
        $this->avatar = $value;

        return $this;
    }

    /**
     * 注册手机号
     * @param string $value
     * @return $this
     */
    public function setPhone(string $value): self
    {
        $this->phone = $value;

        return $this;
    }

    /**
     * 密码
     * @param string $value
     * @return $this
     */
    public function setPassword(string $value): self
    {
        $this->password = $value;

        return $this;
    }

    /**
     * 密码加密盐
     * @param string $value
     * @return $this
     */
    public function setSalt(string $value): self
    {
        $this->salt = $value;

        return $this;
    }

    /**
     * 账号状态 0:未激活 1:启用 -1:禁用
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

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
     * 昵称
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * 性别 0:未设定 1:男 2:女
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * 用户头像
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * 注册手机号
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * 密码
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 密码加密盐
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * 账号状态 0:未激活 1:启用 -1:禁用
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
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
