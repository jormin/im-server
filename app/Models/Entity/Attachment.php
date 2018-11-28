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
 * 附件表

 * @Entity()
 * @Table(name="attachment")
 * @uses      Attachment
 */
class Attachment extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $userId 上传用户ID
     * @Column(name="user_id", type="integer")
     * @Required()
     */
    private $userId;

    /**
     * @var int $attachmentType 文件类型 0:图片 1:音频 2:视频 3:其它
     * @Column(name="attachment_type", type="tinyint")
     * @Required()
     */
    private $attachmentType;

    /**
     * @var string $attachmentPath 文件存储路径
     * @Column(name="attachment_path", type="string", length=100)
     * @Required()
     */
    private $attachmentPath;

    /**
     * @var int $attachmentWidth 图片宽度
     * @Column(name="attachment_width", type="smallint")
     * @Required()
     */
    private $attachmentWidth;

    /**
     * @var int $attachmentHeight 图片高度
     * @Column(name="attachment_height", type="smallint")
     * @Required()
     */
    private $attachmentHeight;

    /**
     * @var int $attachmentDuration 文件时长，单位为秒
     * @Column(name="attachment_duration", type="smallint")
     * @Required()
     */
    private $attachmentDuration;

    /**
     * @var string $attachmentCover 文件封面路径
     * @Column(name="attachment_cover", type="string", length=100)
     * @Required()
     */
    private $attachmentCover;

    /**
     * @var int $attachmentSize 文件尺寸，单位为字节(Byte)
     * @Column(name="attachment_size", type="integer")
     * @Required()
     */
    private $attachmentSize;

    /**
     * @var string $attachmentExtension 文件后缀
     * @Column(name="attachment_extension", type="string", length=15)
     * @Required()
     */
    private $attachmentExtension;

    /**
     * @var string $attachmentMime 文件MIME
     * @Column(name="attachment_mime", type="string", length=100)
     * @Required()
     */
    private $attachmentMime;

    /**
     * @var string $attachmentUploadDate 上传日期
     * @Column(name="attachment_upload_date", type="char", length=10)
     */
    private $attachmentUploadDate;

    /**
     * @var int $attachmentUploadTime 上传时间
     * @Column(name="attachment_upload_time", type="integer")
     */
    private $attachmentUploadTime;

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
     * 上传用户ID
     * @param int $value
     * @return $this
     */
    public function setUserId(int $value): self
    {
        $this->userId = $value;

        return $this;
    }

    /**
     * 文件类型 0:图片 1:音频 2:视频 3:其它
     * @param int $value
     * @return $this
     */
    public function setAttachmentType(int $value): self
    {
        $this->attachmentType = $value;

        return $this;
    }

    /**
     * 文件存储路径
     * @param string $value
     * @return $this
     */
    public function setAttachmentPath(string $value): self
    {
        $this->attachmentPath = $value;

        return $this;
    }

    /**
     * 图片宽度
     * @param int $value
     * @return $this
     */
    public function setAttachmentWidth(int $value): self
    {
        $this->attachmentWidth = $value;

        return $this;
    }

    /**
     * 图片高度
     * @param int $value
     * @return $this
     */
    public function setAttachmentHeight(int $value): self
    {
        $this->attachmentHeight = $value;

        return $this;
    }

    /**
     * 文件时长，单位为秒
     * @param int $value
     * @return $this
     */
    public function setAttachmentDuration(int $value): self
    {
        $this->attachmentDuration = $value;

        return $this;
    }

    /**
     * 文件封面路径
     * @param string $value
     * @return $this
     */
    public function setAttachmentCover(string $value): self
    {
        $this->attachmentCover = $value;

        return $this;
    }

    /**
     * 文件尺寸，单位为字节(Byte)
     * @param int $value
     * @return $this
     */
    public function setAttachmentSize(int $value): self
    {
        $this->attachmentSize = $value;

        return $this;
    }

    /**
     * 文件后缀
     * @param string $value
     * @return $this
     */
    public function setAttachmentExtension(string $value): self
    {
        $this->attachmentExtension = $value;

        return $this;
    }

    /**
     * 文件MIME
     * @param string $value
     * @return $this
     */
    public function setAttachmentMime(string $value): self
    {
        $this->attachmentMime = $value;

        return $this;
    }

    /**
     * 上传日期
     * @param string $value
     * @return $this
     */
    public function setAttachmentUploadDate(string $value): self
    {
        $this->attachmentUploadDate = $value;

        return $this;
    }

    /**
     * 上传时间
     * @param int $value
     * @return $this
     */
    public function setAttachmentUploadTime(int $value): self
    {
        $this->attachmentUploadTime = $value;

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
     * 上传用户ID
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 文件类型 0:图片 1:音频 2:视频 3:其它
     * @return int
     */
    public function getAttachmentType()
    {
        return $this->attachmentType;
    }

    /**
     * 文件存储路径
     * @return string
     */
    public function getAttachmentPath()
    {
        return $this->attachmentPath;
    }

    /**
     * 图片宽度
     * @return int
     */
    public function getAttachmentWidth()
    {
        return $this->attachmentWidth;
    }

    /**
     * 图片高度
     * @return int
     */
    public function getAttachmentHeight()
    {
        return $this->attachmentHeight;
    }

    /**
     * 文件时长，单位为秒
     * @return int
     */
    public function getAttachmentDuration()
    {
        return $this->attachmentDuration;
    }

    /**
     * 文件封面路径
     * @return string
     */
    public function getAttachmentCover()
    {
        return $this->attachmentCover;
    }

    /**
     * 文件尺寸，单位为字节(Byte)
     * @return int
     */
    public function getAttachmentSize()
    {
        return $this->attachmentSize;
    }

    /**
     * 文件后缀
     * @return string
     */
    public function getAttachmentExtension()
    {
        return $this->attachmentExtension;
    }

    /**
     * 文件MIME
     * @return string
     */
    public function getAttachmentMime()
    {
        return $this->attachmentMime;
    }

    /**
     * 上传日期
     * @return string
     */
    public function getAttachmentUploadDate()
    {
        return $this->attachmentUploadDate;
    }

    /**
     * 上传时间
     * @return int
     */
    public function getAttachmentUploadTime()
    {
        return $this->attachmentUploadTime;
    }

}
