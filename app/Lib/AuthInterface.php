<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/13
 * Time: 9:53 AM
 */

namespace App\Lib;


interface AuthInterface
{
    public function tokenLogin(string $token);
}