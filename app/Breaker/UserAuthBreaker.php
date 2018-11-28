<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/13
 * Time: 10:52 AM
 */

namespace App\Breaker;


use Swoft\Bean\Annotation\Value;
use Swoft\Sg\Bean\Annotation\Breaker;
use Swoft\Sg\Circuit\CircuitBreaker;

/**
 * Class UserAuthBreaker
 * @package App\Breaker
 * @Breaker(name="userAuth")
 */
class UserAuthBreaker extends CircuitBreaker
{
    /**
     * The number of successive failures
     * If the arrival, the state switch to open
     *
     * @Value(name="${config.breaker.kefuAuth.failCount}", env="${KEFU_AUTH_BREAKER_FAIL_COUNT}")
     * @var int
     */
    protected $switchToFailCount = 3;

    /**
     * The number of successive successes
     * If the arrival, the state switch to close
     *
     * @Value(name="${config.breaker.kefuAuth.successCount}", env="${KEFU_AUTH_BREAKER_SUCCESS_COUNT}")
     * @var int
     */
    protected $switchToSuccessCount = 3;

    /**
     * Switch close to open delay time
     * The unit is milliseconds
     *
     * @Value(name="${config.breaker.kefuAuth.delayTime}", env="${KEFU_AUTH_BREAKER_DELAY_TIME}")
     * @var int
     */
    protected $delaySwitchTimer = 500;
}