<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-08
 * Time: 14:03
 */

namespace App\Controllers;


use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;

/**
 * Class TestController
 * @Controller("/test")
 * @package App\Controllers
 */
class TestController extends AuthController
{

    /**
     * @RequestMapping("index")
     */
    public function index()
    {
        return ['a' => 1, 'b' => 2];
    }

}
