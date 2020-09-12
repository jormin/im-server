<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-08
 * Time: 13:54
 */

namespace App\Controllers;


use App\Services\PhoneCodeService;
use App\Services\UserAuthService;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;

/**
 * Class AuthController
 * @package App\Controllers
 * @Controller("/auth")
 */
class AuthController extends BaseController
{

    /**
     * @Inject()
     * @var UserAuthService 用户鉴权Service
     */
    protected $userAuthService;

    /**
     * @Inject()
     * @var PhoneCodeService 发送短信验证码Service
     */
    protected $phoneCodeService;

    /**
     * 登录
     * @RequestMapping(route="login", method=RequestMethod::POST)
     */
    public function login(){
        $phone = $this->getParam('phone');
        $password = $this->getParam('password');
        return $this->userAuthService->login($phone, $password);
    }

    /**
     * 注册
     * @RequestMapping(route="register", method=RequestMethod::POST)
     */
    public function register(){
        $phone = $this->getParam('phone');
        $password = $this->getParam('password');
        $code = $this->getParam('code');
        $nickname = $this->getParam('nickname');
        return $this->userAuthService->register($phone, $password, $code, $nickname);
    }

    /**
     * 注册验证码
     * @RequestMapping(route="sendCode", method=RequestMethod::POST)
     */
    public function sendCode(){
        $phone = $this->getParam('phone');
        $type = $this->getParam('type');
        return $this->phoneCodeService->sendCode(intval($type), $phone);
    }

    /**
     * 重置密码
     * @RequestMapping(route="reset", method=RequestMethod::POST)
     */
    public function reset(){
        $phone = $this->getParam('phone');
        $password = $this->getParam('password');
        $code = $this->getParam('code');
        return $this->userAuthService->reset($phone, $password, $code);
    }

}
