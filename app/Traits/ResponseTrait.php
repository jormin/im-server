<?php
/**
 * Created by PhpStorm.
 * User: 谢乔敏
 * Date: 2018-12-05
 * Time: 09:58
 */

namespace App\Traits;


/**
 * 响应处理 Trait
 * @package app\Traits
 */
trait ResponseTrait
{

    /**
     * 操作成功
     * @param string $message
     * @param array $data
     * @return array
     */
    public function success($message = '操作成功', $data = array())
    {
        return ['code' => 0, 'message' => $message, 'data' => $data];
    }

    /**
     * 操作失败
     * @param string $message
     * @param array $data
     * @return array
     */
    public function failed($message = '操作失败', $data = array())
    {
        return ['code' => -1, 'message' => $message, 'data' => $data];
    }

    /**
     * 鉴权失败
     * @param string $message
     * @param array $data
     * @return array
     */
    public function authFailed($message = '鉴权失败', $data = array())
    {
        return ['code' => -2, 'message' => $message, 'data' => $data];
    }

}
