<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/15
 * Time: 11:28 AM
 */

namespace App\Services;

use App\Traits\SenderTrait;
use Swoft\Bean\Annotation\Inject;
use Swoft\Rpc\Server\Bean\Annotation\Service;

/**
 * Class BaseService
 * @package App\Services
 * @Service()
 */
class BaseService
{

    use SenderTrait;

    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    protected $redis;
}