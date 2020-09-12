<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:58
 */

namespace App\Traits;


/**
 * 日志处理 Trait
 * @package app\Traits
 */
trait LogTrait
{

    /**
     * 记录日志
     * @param $message
     * @param $flag
     * @param null $fileName
     * @param null $pathName
     */
    public function recordLog($message, $flag, $fileName = null, $pathName = null)
    {
        $classFullyName = get_called_class();
        $classFullyNameArr = explode('\\', $classFullyName);
        $className = array_pop($classFullyNameArr);
        $fileName = $fileName ?? $className;
        $pathName = $pathName ?? $className;
        recordLog($message, $flag, $fileName, LOG_DIR . DIRECTORY_SEPARATOR . $pathName);
    }

}
