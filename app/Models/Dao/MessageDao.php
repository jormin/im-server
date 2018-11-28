<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/16
 * Time: 9:37 AM
 */

namespace App\Models\Dao;

use App\Models\Entity\Message;
use Swoft\Bean\Annotation\Bean;

/**
 * Class MessageDao
 * @package App\Models\Dao
 * @Bean()
 */
class MessageDao
{

    /**
     * 保存消息
     * @param $data
     * @return Message|bool
     */
    public function saveMessage($data){
        $message = new Message();
        $result = $message->fill($data)->save()->getResult();
        return $result ? $message : false;
    }

}