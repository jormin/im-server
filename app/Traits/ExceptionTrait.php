<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:58
 */

namespace App\Traits;


use app\BaseException;
use Monolog\Logger;

/**
 * 异常处理 Trait
 * @package app\Traits
 */
trait ExceptionTrait
{

    /**
     * 抛出异常
     * @param $message
     * @param int $code
     * @param null $previous
     * @param null $logMessage
     * @param int $level
     * @throws BaseException
     */
    public function exception($message, $code = -1, $previous = null, $logMessage = null, $level = 3)
    {
        $logLevels = ['DEBUG', 'INFO', 'NOTICE', 'WARNING', 'ERROR', 'CRITICAL', 'ALERT', 'EMERGENCY'];
        if(!is_int($level) || $level < 0 || $level >= count($logLevels)){
            $level = 3;
        }
        $logMessage = $logMessage ?? [$message, __METHOD__];
        throw new BaseException($message, $code, $previous, $logMessage, Logger::getLevels()[$logLevels[$level]]);
    }

}
