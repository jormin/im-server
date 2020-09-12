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
 * 手机验证码表

 * @Entity()
 * @Table(name="im_phone_code")
 * @uses      PhoneCode
 */
class PhoneCode extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $type 类型 0:注册 1:重置密码 2:修改密码
     * @Column(name="type", type="tinyint")
     * @Required()
     */
    private $type;

    /**
     * @var string $phone 手机号
     * @Column(name="phone", type="char", length=11)
     * @Required()
     */
    private $phone;

    /**
     * @var string $code 验证码
     * @Column(name="code", type="char", length=6)
     * @Required()
     */
    private $code;

    /**
     * @var int $expireTime 过期时间
     * @Column(name="expire_time", type="integer")
     * @Required()
     */
    private $expireTime;

    /**
     * @var int $validateTime 验证时间
     * @Column(name="validate_time", type="integer", default=0)
     */
    private $validateTime;

    /**
     * @var int $createTime 创建时间戳
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
     * 类型 0:注册 1:重置密码 2:修改密码
     * @param int $value
     * @return $this
     */
    public function setType(int $value): self
    {
        $this->type = $value;

        return $this;
    }

    /**
     * 手机号
     * @param string $value
     * @return $this
     */
    public function setPhone(string $value): self
    {
        $this->phone = $value;

        return $this;
    }

    /**
     * 验证码
     * @param string $value
     * @return $this
     */
    public function setCode(string $value): self
    {
        $this->code = $value;

        return $this;
    }

    /**
     * 过期时间
     * @param int $value
     * @return $this
     */
    public function setExpireTime(int $value): self
    {
        $this->expireTime = $value;

        return $this;
    }

    /**
     * 验证时间
     * @param int $value
     * @return $this
     */
    public function setValidateTime(int $value): self
    {
        $this->validateTime = $value;

        return $this;
    }

    /**
     * 创建时间戳
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
     * 类型 0:注册 1:重置密码 2:修改密码
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * 手机号
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * 验证码
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * 过期时间
     * @return int
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

    /**
     * 验证时间
     * @return int
     */
    public function getValidateTime()
    {
        return $this->validateTime;
    }

    /**
     * 创建时间戳
     * @return int
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

}
