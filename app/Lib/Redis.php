<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-09
 * Time: 15:23
 */

namespace App\Lib;

use Swoft\Bean\Annotation\Bean;

/**
 * Class Redis
 * @package App\Lib
 * @Bean()
 */
class Redis extends \Swoft\Redis\Redis
{

    /**
     * 设置有效期缓存值
     * @param $key
     * @param $value
     * @param $expire
     * @return bool
     */
    public function setEx($key, $value, $expire): bool
    {
        $params = [$key, $expire, $value];
        return $this->call('setex', $params);
    }
}
