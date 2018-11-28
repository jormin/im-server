<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/14
 * Time: 3:02 PM
 */

namespace App\Pool;


use App\Pool\Config\KefuPoolConfig;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Pool;
use Swoft\Rpc\Client\Pool\ServicePool;

/**
 * Class KefuServicePool
 * @package App\Pool
 * @Pool(name="kefu")
 */
class KefuServicePool extends ServicePool
{

    /**
     * @Inject()
     * @var KefuPoolConfig
     */
    protected $poolConfig;

}