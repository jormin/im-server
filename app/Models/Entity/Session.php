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
 * 会话表

 * @Entity()
 * @Table(name="im_session")
 * @uses      Session
 */
class Session extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $creatorId 发起者ID
     * @Column(name="creator_id", type="integer")
     * @Required()
     */
    private $creatorId;

    /**
     * @var int $participantId 参与者ID
     * @Column(name="participant_id", type="integer")
     * @Required()
     */
    private $participantId;

    /**
     * @var int $createTime 创建时间
     * @Column(name="create_time", type="integer")
     * @Required()
     */
    private $createTime;

    /**
     * @var int $updateTime 最近活跃时间
     * @Column(name="update_time", type="integer")
     * @Required()
     */
    private $updateTime;

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
     * 发起者ID
     * @param int $value
     * @return $this
     */
    public function setCreatorId(int $value): self
    {
        $this->creatorId = $value;

        return $this;
    }

    /**
     * 参与者ID
     * @param int $value
     * @return $this
     */
    public function setParticipantId(int $value): self
    {
        $this->participantId = $value;

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
     * 最近活跃时间
     * @param int $value
     * @return $this
     */
    public function setUpdateTime(int $value): self
    {
        $this->updateTime = $value;

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
     * 发起者ID
     * @return int
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * 参与者ID
     * @return int
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }

    /**
     * 创建时间
     * @return int
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * 最近活跃时间
     * @return int
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

}
