<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-08
 * Time: 13:13
 */

namespace App\Controllers;


use App\Models\Data\UserData;
use App\Models\Entity\User;
use App\Traits\ResponseTrait;
use Swoft\Bean\Annotation\Inject;

/**
 * 基础控制器
 * @package App\Controllers
 */
class BaseController
{

    use ResponseTrait;

    /**
     * @var array 当前请求参数
     */
    protected $params;

    /**
     * 获取请求参数
     * @param string $param
     * @return mixed|null
     */
    public function getParam(string $param){
        $request = request();
        $this->params = $request->getMethod() === 'GET' ? $request->query() : $request->post();
        return $this->params[$param] ?? null;
    }

    public function __destruct()
    {
        unset($this->params);
    }
}
