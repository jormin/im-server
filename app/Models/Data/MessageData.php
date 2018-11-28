<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/16
 * Time: 10:12 AM
 */

namespace App\Models\Data;

use App\Models\Dao\MessageContentDao;
use App\Models\Dao\MessageDao;
use App\Models\Dao\MessageExtendDao;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;
use Swoft\Db\Db;

/**
 * Class MessageData
 * @package App\Models\Data
 * @Bean()
 */
class MessageData
{
    /**
     * @Inject()
     * @var MessageDao
     */
    private $messageDao;

    /**
     * @Inject()
     * @var MessageContentDao
     */
    private $messageContentDao;

    /**
     * @Inject()
     * @var MessageExtendDao
     */
    private $messageExtendDao;

    /**
     * 保存消息
     * @param $data
     * @return bool
     */
    public function saveMessage($data){
        Db::beginTransaction();
        $result = $this->messageDao->saveMessage($data);
        if($result === false){
            Db::rollback();
            return false;
        }
        $messageId = $result->getId();
        $data['messageId'] = $messageId;
        $result = $this->messageContentDao->saveMessageContent($data);
        if($result === false){
            Db::rollback();
            return false;
        }
        $result = $this->messageExtendDao->saveMessageExtend($data);
        if($result === false){
            Db::rollback();
            return false;
        }
        Db::commit();
        return true;
    }

}
