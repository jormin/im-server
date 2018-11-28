<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/13
 * Time: 10:20 AM
 */

namespace App\Pool;


use App\Pool\Config\UserAuthPoolConfig;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Pool;
use Swoft\Rpc\Client\Pool\ServicePool;

/**
 * 用户验证服务对象池
 * @package App\Pool
 * @Pool(name="userAuth")
 */
class UserAuthServicePool extends ServicePool
{

    /**
     * @Inject()
     *
     * @var UserAuthPoolConfig
     */
    protected $poolConfig;

}