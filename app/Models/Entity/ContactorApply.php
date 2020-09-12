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
 * 联系人表

 * @Entity()
 * @Table(name="im_contactor_apply")
 * @uses      ContactorApply
 */
class ContactorApply extends Model
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
     * @var int $contactorId 联系人ID
     * @Column(name="contactor_id", type="integer")
     * @Required()
     */
    private $contactorId;

    /**
     * @var int $status 状态 0:待处理 1:已通过 -1:已拒绝
     * @Column(name="status", type="tinyint")
     * @Required()
     */
    private $status;

    /**
     * @var string $remark 申请备注
     * @Column(name="remark", type="string", length=200)
     * @Required()
     */
    private $remark;

    /**
     * @var int $createTime 创建时间
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
     * 联系人ID
     * @param int $value
     * @return $this
     */
    public function setContactorId(int $value): self
    {
        $this->contactorId = $value;

        return $this;
    }

    /**
     * 状态 0:待处理 1:已通过 -1:已拒绝
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * 申请备注
     * @param string $value
     * @return $this
     */
    public function setRemark(string $value): self
    {
        $this->remark = $value;

        return $this;
    }

    /**
     * 创建时间
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
     * 用户ID
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 联系人ID
     * @return int
     */
    public function getContactorId()
    {
        return $this->contactorId;
    }

    /**
     * 状态 0:待处理 1:已通过 -1:已拒绝
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 申请备注
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * 创建时间
     * @return int
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

}
