<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/13
 * Time: 10:20 AM
 */

namespace App\Pool;


use App\Pool\Config\KefuAuthPoolConfig;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Pool;
use Swoft\Rpc\Client\Pool\ServicePool;

/**
 * 客服验证服务对象池
 * @package App\Pool
 * @Pool(name="kefuAuth")
 */
class KefuAuthServicePool extends ServicePool
{

    /**
     * @Inject()
     *
     * @var KefuAuthPoolConfig
     */
    protected $poolConfig;

}