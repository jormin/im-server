<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/14
 * Time: 2:07 PM
 */

namespace App\Lib;


use App\Models\Entity\Kefu;

/**
 * Interface KefuInterface
 * @package App\Lib
 */
interface KefuInterface
{

    /**
     * 客服上线
     * @param Kefu $kefu
     * @param int $fd
     * @return mixed
     */
    public function online(Kefu $kefu, int $fd);

    /**
     * 客服下线
     * @param Kefu $kefu
     * @param int $fd
     * @return mixed
     */
    public function offline(Kefu $kefu, int $fd);

    /**
     * 发送消息
     * @param Kefu $kefu
     * @param int $fd
     * @param array $data
     * @return mixed
     */
    public function sendMessage(Kefu $kefu, int $fd, array $data);

}