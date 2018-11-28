<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/13
 * Time: 9:55 AM
 */

namespace App\Services;


use App\Lib\AuthInterface;
use App\Models\Dao\KefuDao;
use Swoft\Bean\Annotation\Inject;
use Swoft\Rpc\Server\Bean\Annotation\Service;

/**
 * Class KefuAuthService
 * @package App\Services
 *
 * @Service()
 */
class KefuAuthService implements AuthInterface
{

    /**
     * @Inject()
     * @var KefuDao
     */
    private $kefuDao;

    /**
     * 客服Token验证
     * @param string $token
     * @return bool|mixed
     */
    public function tokenLogin(string $token)
    {
        if(!$token){
            return false;
        }
        $kefu = $this->kefuDao->getKefu($token);
        return $kefu ?? false;
    }

}