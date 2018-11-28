<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/15
 * Time: 1:04 PM
 */

namespace App\Lib;


use App\Models\Entity\User;

/**
 * Interface UserInterface
 * @package App\Lib
 */
interface UserInterface
{

    /**
     * 用户上线
     * @param User $user
     * @param int $fd
     * @return mixed
     */
    public function online(User $user, int $fd);

    /**
     * 用户下线
     * @param User $user
     * @param int $fd
     * @return mixed
     */
    public function offline(User $user, int $fd);

    /**
     * 发送消息
     * @param User $user
     * @param int $fd
     * @param array $data
     * @return mixed
     */
    public function sendMessage(User $user, int $fd, array $data);

}