<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/13
 * Time: 9:55 AM
 */

namespace App\Services;


use App\Lib\AuthInterface;
use App\Models\Dao\UserDao;
use Swoft\Bean\Annotation\Inject;
use Swoft\Rpc\Server\Bean\Annotation\Service;

/**
 * Class UserAuthService
 * @package App\Services
 *
 * @Service()
 */
class UserAuthService implements AuthInterface
{

    /**
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    /**
     * 用户Token验证
     * @param string $token
     * @return bool|mixed
     */
    public function tokenLogin(string $token)
    {
        if(!$token){
            return false;
        }
        $user = $this->userDao->getUser($token);
        return $user ?? false;
    }

}