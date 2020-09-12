<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-09
 * Time: 16:10
 */

return [
    'encryptKey' => env('ENCRYPT_KEY', ''),
    'jwtExpire' => env('JWT_EXPIRE', ''),
    'phoneCodeExpire' => env('PHONE_CODE_EXPIRE', ''),
    'aliyun' => [
        'accessKeyId' => env('ACCESS_KEY_ID', ''),
        'accessKeySecret' => env('ACCESS_KEY_SECRET', ''),
        'signature' => env('SIGNATURE', ''),
        'registerCode' => env('REGISTER_CODE', ''),
        'resetPasswordCode' => env('RESET_PASSWORD_CODE', ''),
        'modifyPasswordCode' => env('MODIFY_PASSWORD_CODE', '')
    ],
    'user' => [
        'defaultAvatar' => env('USER_DEFAULT_AVATAR', '')
    ]
];
