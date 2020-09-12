<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:58
 */

namespace App\Traits;


/**
 * 事务处理Trait
 * @package app\Traits
 */
trait TransactionTrait
{

    /**
     * 获取指定数据库的对象池
     * @param $database
     * @return mixed
     */
    private function getMysqlpool($database)
    {
        return get_instance()->getAsynPool('mysqlPool_' . $database);
    }

    /**
     * 开启事务
     * @param $database
     * @return \Generator
     */
    public function beginTransaction($database)
    {
        return yield $this->getMysqlpool($database)->coroutineBegin($this);
    }

    /**
     * 回滚事务
     * @param $database
     * @param $transactionID
     * @return \Generator
     */
    public function rollbackTransaction($database, $transactionID)
    {
        yield $this->getMysqlpool($database)->coroutineRollback($transactionID);
    }

    /**
     * 提交事务
     * @param $database
     * @param $transactionID
     * @return \Generator
     */
    public function commitTransaction($database, $transactionID)
    {
        yield $this->getMysqlpool($database)->coroutineCommit($transactionID);
    }

}
