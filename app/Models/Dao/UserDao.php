<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/14
 * Time: 3:09 PM
 */

namespace App\Models\Dao;


use App\Models\Entity\User;
use Swoft\Bean\Annotation\Bean;

/**
 * Class UserDao
 * @package App\Models\Dao
 * @Bean()
 */
class UserDao
{

    /**
     * 根据ID查询
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $user = User::findById($id)->getResult();
        return $user;
    }

    /**
     * 添加用户
     * @param $data
     * @return User|mixed
     */
    public function createUser($data)
    {
        $user = new User();
        $user->setCreateTime(time());
        $result = $user->fill($data)->save()->getResult();
        return $result ? $user : false;
    }

}