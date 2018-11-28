<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/16
 * Time: 9:37 AM
 */

namespace App\Models\Dao;

use App\Models\Entity\MessageContent;
use Swoft\Bean\Annotation\Bean;

/**
 * Class MessageContentDao
 * @package App\Models\Dao
 * @Bean()
 */
class MessageContentDao
{

    /**
     * 保存消息内容信息
     * @param $data
     * @return MessageContent|bool
     */
    public function saveMessageContent($data){
        $messageContent = new MessageContent();
        $result = $messageContent->fill($data)->save()->getResult();
        return $result ? $messageContent : false;
    }

}