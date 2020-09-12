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
 * 消息类型表，当前支持六种：1:文本 2:图片 3:语音 4:视频 5:文件 6:位置

 * @Entity()
 * @Table(name="im_message_type")
 * @uses      MessageType
 */
class MessageType extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="smallint")
     */
    private $id;

    /**
     * @var string $name 类型名称
     * @Column(name="name", type="string", length=35)
     * @Required()
     */
    private $name;

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
     * 类型名称
     * @param string $value
     * @return $this
     */
    public function setName(string $value): self
    {
        $this->name = $value;

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
     * 类型名称
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
