<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/16
 * Time: 9:37 AM
 */

namespace App\Models\Dao;

use App\Models\Entity\MessageExtend;
use Swoft\Bean\Annotation\Bean;

/**
 * Class MessageExtendDao
 * @package App\Models\Dao
 * @Bean()
 */
class MessageExtendDao
{

    /**
     * 保存消息扩展信息
     * @param $data
     * @return MessageExtend|bool
     */
    public function saveMessageExtend($data){
        $messageExtend = new MessageExtend();
        $result = $messageExtend->fill($data)->save()->getResult();
        return $result ? $messageExtend : false;
    }

}