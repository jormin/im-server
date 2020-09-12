<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/13
 * Time: 9:55 AM
 */

namespace App\Services;


use app\Common\CommonFunction;
use App\Lib\AuthInterface;
use App\Models\Dao\UserDao;
use Firebase\JWT\JWT;
use Swoft\Bean\Annotation\Inject;
use Swoft\Rpc\Server\Bean\Annotation\Service;

/**
 * Class UserAuthService
 * @package App\Services
 *
 * @Service()
 */
class UserAuthService extends BaseService implements AuthInterface
{

    /**
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    /**
     * @Inject()
     * @var PhoneCodeService 手机验证码Service
     */
    private $phoneCodeService;


    /**
     * 用户Token验证
     * @param string $token
     * @return bool|mixed
     */
    public function tokenLogin(string $token)
    {
        if (!$token) {
            return $this->authFailed();
        }
        $user = $this->userDao->getUser($token);
        if (!$user) {
            return $this->authFailed();
        }
        return $this->success('登录成功 ', ['user' => $this->userDao->simpleUser($user)]);
    }

    /**
     * 用户手机号密码验证
     * @param string $phone
     * @param string $password
     * @return bool|mixed
     */
    public function login(string $phone, string $password)
    {
        if (!$phone || !$password) {
            return $this->failed('手机号或密码不能为空');
        }
        $user = $this->userDao->getUserByPhone($phone);
        if (!$user) {
            return $this->failed('手机号错误');
        }
        $encryptKey = CommonFunction::getEncryptKey();
        if (!password_verify($password . $user['salt'] . $encryptKey, $user['password'])) {
            return $this->failed('密码错误');
        }
        // 过滤敏感数据
        $user = $this->userDao->simpleUser($user);
        // 生成JWTtoken
        $user = $this->encodeAuthToken($user);
        return $this->success('登录成功 ', ['user' => $user]);
    }

    /**
     * 注册成功
     * @param string $phone
     * @param string $password
     * @param string $code
     * @param string $nickname
     * @return array
     */
    public function register(string $phone, string $password, string $code, string $nickname)
    {
        if (!$phone || !$password || !$code || !$nickname) {
            return $this->failed('参数错误');
        }
        // 校验验证码
        $response = $this->phoneCodeService->validateCode(PhoneCodeService::REGISTER, $phone, $code);
        if($response['code'] !== 0){
            return $response;
        }
        // 写入用户信息
        $salt = CommonFunction::getRandChar(10);
        $encryptKey = CommonFunction::getEncryptKey();
        $password = password_hash($password . $salt . $encryptKey, PASSWORD_BCRYPT);
        $user = $this->userDao->createUser([
            'phone' => $phone,
            'salt' => $salt,
            'nickname' => $nickname,
            'password' => $password
        ]);
        if (!$user) {
            return $this->failed('写入数据失败');
        }
        return $this->success('注册成功 ', ['user' => $this->userDao->simpleUser($user)]);
    }

    /**
     * 重置密码
     * @param string $phone
     * @param string $password
     * @param string $code
     * @return array
     */
    public function reset(string $phone, string $password, string $code)
    {
        if (!$phone || !$password || !$code) {
            return $this->failed('参数错误');
        }
        // 校验验证码
        $response = $this->phoneCodeService->validateCode(PhoneCodeService::RESET, $phone, $code);
        if($response['code'] !== 0){
            return $response;
        }
        $user = $this->userDao->getUserByPhone($phone);
        if(!$user){
            return $this->failed('该手机号尚未注册');
        }
        $encryptKey = CommonFunction::getEncryptKey();
        // 校验密码
        if (password_verify($password . $user['salt'] . $encryptKey, $user['password'])) {
            return $this->failed('请设置之前未曾使用的密码');
        }
        // 修改密码信息
        $password = password_hash($password . $user['salt'] . $encryptKey, PASSWORD_BCRYPT);
        $result = $this->userDao->changePassword($user['id'], $password);
        if(!$result){
            return $this->failed('更新密码失败');
        }
        return $this->success('重置密码成功 ');
    }

    /**
     * 生成用户JWTToken
     * @param array $user
     * @return array
     */
    public function encodeAuthToken(array $user){
        $tokenData = array(
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + intval(CommonFunction::getCustomConfig('jwtExpire')),
            'uid' => $user['id']
        );
        $token = JWT::encode($tokenData, CommonFunction::getEncryptKey());
        $user['token'] = $token;
        return $user;
    }

    /**
     * 解密用户JWTToken
     * @param string $token
     * @return mixed
     */
    public function decodeAuthToken(string $token){
        $decoded = JWT::decode($token, CommonFunction::getEncryptKey(), array('HS256'));
        return $decoded;
    }

}
