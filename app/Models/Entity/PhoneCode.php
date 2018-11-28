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
 * @Table(name="phone_code")
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
     * @var int $pcType 类型 0:注册 1:重置密码 2:修改密码
     * @Column(name="pc_type", type="tinyint")
     * @Required()
     */
    private $pcType;

    /**
     * @var string $pcPhone 手机号
     * @Column(name="pc_phone", type="char", length=11)
     * @Required()
     */
    private $pcPhone;

    /**
     * @var string $pcCode 验证码
     * @Column(name="pc_code", type="char", length=6)
     * @Required()
     */
    private $pcCode;

    /**
     * @var int $pcExpireTime 过期时间
     * @Column(name="pc_expire_time", type="integer")
     * @Required()
     */
    private $pcExpireTime;

    /**
     * @var int $pcValidateTime 验证时间
     * @Column(name="pc_validate_time", type="integer", default=0)
     */
    private $pcValidateTime;

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
    public function setPcType(int $value): self
    {
        $this->pcType = $value;

        return $this;
    }

    /**
     * 手机号
     * @param string $value
     * @return $this
     */
    public function setPcPhone(string $value): self
    {
        $this->pcPhone = $value;

        return $this;
    }

    /**
     * 验证码
     * @param string $value
     * @return $this
     */
    public function setPcCode(string $value): self
    {
        $this->pcCode = $value;

        return $this;
    }

    /**
     * 过期时间
     * @param int $value
     * @return $this
     */
    public function setPcExpireTime(int $value): self
    {
        $this->pcExpireTime = $value;

        return $this;
    }

    /**
     * 验证时间
     * @param int $value
     * @return $this
     */
    public function setPcValidateTime(int $value): self
    {
        $this->pcValidateTime = $value;

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
    public function getPcType()
    {
        return $this->pcType;
    }

    /**
     * 手机号
     * @return string
     */
    public function getPcPhone()
    {
        return $this->pcPhone;
    }

    /**
     * 验证码
     * @return string
     */
    public function getPcCode()
    {
        return $this->pcCode;
    }

    /**
     * 过期时间
     * @return int
     */
    public function getPcExpireTime()
    {
        return $this->pcExpireTime;
    }

    /**
     * 验证时间
     * @return int
     */
    public function getPcValidateTime()
    {
        return $this->pcValidateTime;
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
