<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/14
 * Time: 3:09 PM
 */

namespace App\Models\Dao;


use app\Common\CommonFunction;
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
     * @param int $id
     * @return mixed
     */
    public function getUser(int $id)
    {
        $user = User::findById($id)->getResult();
        return $user;
    }

    /**
     * 根据手机号查询
     * @param $phone
     * @return mixed
     */
    public function getUserByPhone(string $phone)
    {
        $user = User::findOne(['phone' => $phone])->getResult();
        return $user;
    }

    /**
     * 根据Token查询
     * @param $token
     * @return mixed
     */
    public function getUserByToken(string $token)
    {
        $user = User::findOne(['token' => $token])->getResult();
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

    /**
     * 处理用户信息
     * @param User $user
     * @return mixed
     */
    public function simpleUser($user){
        $user = $user->getAttrs();
        unset($user['salt']);
        unset($user['password']);
        unset($user['status']);
        if($user['avatar']){
           $user['avatar'] = CommonFunction::getCustomConfig('user.defaultAvatar');
        }
        return $user;
    }

    /**
     * 更新密码
     * @param int $id
     * @param string $password
     * @return mixed
     */
    public function changePassword(int $id, string $password)
    {
        return User::updateOne(['password' => $password], ['id' => $id])->getResult();
    }

}
