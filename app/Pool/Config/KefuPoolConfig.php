<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/13
 * Time: 10:22 AM
 */

namespace App\Pool\Config;


use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Value;
use Swoft\Pool\PoolProperties;

/**
 * Class KefuPoolConfig
 * @package App\Pool\Config
 * @Bean()
 */
class KefuPoolConfig extends PoolProperties
{

    /**
     * the name of pool
     *
     * @Value(name="${config.service.kefu.name}", env="${KEFU_POOL_NAME}")
     * @var string
     */
    protected $name = '';

    /**
     * Minimum active number of connections
     *
     * @Value(name="${config.service.kefu.minActive}", env="${KEFU_POOL_MIN_ACTIVE}")
     * @var int
     */
    protected $minActive = 5;

    /**
     * the maximum number of active connections
     *
     * @Value(name="${config.service.kefu.maxActive}", env="${KEFU_POOL_MAX_ACTIVE}")
     * @var int
     */
    protected $maxActive = 50;

    /**
     * the maximum number of wait connections
     *
     * @Value(name="${config.service.kefu.maxWait}", env="${KEFU_POOL_MAX_WAIT}")
     * @var int
     */
    protected $maxWait = 100;

    /**
     * Maximum waiting time
     *
     * @Value(name="${config.service.kefu.maxWaitTime}", env="${KEFU_POOL_MAX_WAIT_TIME}")
     * @var int
     */
    protected $maxWaitTime = 3;

    /**
     * Maximum idle time
     *
     * @Value(name="${config.service.kefu.maxIdleTime}", env="${KEFU_POOL_MAX_IDLE_TIME}")
     * @var int
     */
    protected $maxIdleTime = 60;

    /**
     * the time of connect timeout
     *
     * @Value(name="${config.service.kefu.timeout}", env="${KEFU_POOL_TIMEOUT}")
     * @var int
     */
    protected $timeout = 200;

    /**
     * the addresses of connection
     *
     * <pre>
     * [
     *  '127.0.0.1:88',
     *  '127.0.0.1:88'
     * ]
     * </pre>
     *
     * @Value(name="${config.service.kefu.uri}", env="${KEFU_POOL_URI}")
     * @var array
     */
    protected $uri = [];

    /**
     * whether to user provider(consul/etcd/zookeeper)
     *
     * @Value(name="${config.service.kefu.useProvider}", env="${KEFU_POOL_USE_PROVIDER}")
     * @var bool
     */
    protected $useProvider = false;

    /**
     * the default balancer is random balancer
     *
     * @Value(name="${config.service.kefu.balancer}", env="${KEFU_POOL_BALANCER}")
     * @var string
     */
    protected $balancer = '';

    /**
     * the default provider is consul provider
     *
     * @Value(name="${config.service.kefu.provider}", env="${KEFU_POOL_PROVIDER}")
     * @var string
     */
    protected $provider = '';

}