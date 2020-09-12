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
 * @Table(name="im_attachment")
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
     * @var int $type 文件类型 0:图片 1:音频 2:视频 3:其它
     * @Column(name="type", type="tinyint")
     * @Required()
     */
    private $type;

    /**
     * @var string $path 文件存储路径
     * @Column(name="path", type="string", length=100)
     * @Required()
     */
    private $path;

    /**
     * @var int $width 图片宽度
     * @Column(name="width", type="smallint")
     * @Required()
     */
    private $width;

    /**
     * @var int $height 图片高度
     * @Column(name="height", type="smallint")
     * @Required()
     */
    private $height;

    /**
     * @var int $duration 文件时长，单位为秒
     * @Column(name="duration", type="smallint")
     * @Required()
     */
    private $duration;

    /**
     * @var string $cover 文件封面路径
     * @Column(name="cover", type="string", length=100)
     * @Required()
     */
    private $cover;

    /**
     * @var int $size 文件尺寸，单位为字节(Byte)
     * @Column(name="size", type="integer")
     * @Required()
     */
    private $size;

    /**
     * @var string $extension 文件后缀
     * @Column(name="extension", type="string", length=15)
     * @Required()
     */
    private $extension;

    /**
     * @var string $mime 文件MIME
     * @Column(name="mime", type="string", length=100)
     * @Required()
     */
    private $mime;

    /**
     * @var int $uploadTime 上传时间
     * @Column(name="upload_time", type="integer")
     */
    private $uploadTime;

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
    public function setType(int $value): self
    {
        $this->type = $value;

        return $this;
    }

    /**
     * 文件存储路径
     * @param string $value
     * @return $this
     */
    public function setPath(string $value): self
    {
        $this->path = $value;

        return $this;
    }

    /**
     * 图片宽度
     * @param int $value
     * @return $this
     */
    public function setWidth(int $value): self
    {
        $this->width = $value;

        return $this;
    }

    /**
     * 图片高度
     * @param int $value
     * @return $this
     */
    public function setHeight(int $value): self
    {
        $this->height = $value;

        return $this;
    }

    /**
     * 文件时长，单位为秒
     * @param int $value
     * @return $this
     */
    public function setDuration(int $value): self
    {
        $this->duration = $value;

        return $this;
    }

    /**
     * 文件封面路径
     * @param string $value
     * @return $this
     */
    public function setCover(string $value): self
    {
        $this->cover = $value;

        return $this;
    }

    /**
     * 文件尺寸，单位为字节(Byte)
     * @param int $value
     * @return $this
     */
    public function setSize(int $value): self
    {
        $this->size = $value;

        return $this;
    }

    /**
     * 文件后缀
     * @param string $value
     * @return $this
     */
    public function setExtension(string $value): self
    {
        $this->extension = $value;

        return $this;
    }

    /**
     * 文件MIME
     * @param string $value
     * @return $this
     */
    public function setMime(string $value): self
    {
        $this->mime = $value;

        return $this;
    }

    /**
     * 上传时间
     * @param int $value
     * @return $this
     */
    public function setUploadTime(int $value): self
    {
        $this->uploadTime = $value;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * 文件存储路径
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * 图片宽度
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * 图片高度
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * 文件时长，单位为秒
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * 文件封面路径
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * 文件尺寸，单位为字节(Byte)
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * 文件后缀
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * 文件MIME
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * 上传时间
     * @return int
     */
    public function getUploadTime()
    {
        return $this->uploadTime;
    }

}
