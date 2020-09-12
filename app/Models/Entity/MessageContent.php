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
 * 消息内容表，存储消息表中 message_type 为 0(文本)|5(位置) 的消息，如果是位置消息，存储格式为：经度,纬度

 * @Entity()
 * @Table(name="im_message_content")
 * @uses      MessageContent
 */
class MessageContent extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $messageId 消息ID
     * @Column(name="message_id", type="integer")
     * @Required()
     */
    private $messageId;

    /**
     * @var string $content 消息内容
     * @Column(name="content", type="string", length=6000)
     * @Required()
     */
    private $content;

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
     * 消息ID
     * @param int $value
     * @return $this
     */
    public function setMessageId(int $value): self
    {
        $this->messageId = $value;

        return $this;
    }

    /**
     * 消息内容
     * @param string $value
     * @return $this
     */
    public function setContent(string $value): self
    {
        $this->content = $value;

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
     * 消息ID
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * 消息内容
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

}
