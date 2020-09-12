<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-09
 * Time: 19:48
 */

namespace App\Models\Dao;


use App\Models\Entity\PhoneCode;
use Swoft\Bean\Annotation\Bean;

/**
 * Class PhoneCodeDao
 * @package App\Models\Dao
 * @Bean()
 */
class PhoneCodeDao
{

    /**
     * 添加验证码
     * @param array $data
     * @return PhoneCode|bool
     */
    public function createPhoneCode(array $data)
    {
        $phoneCode = new PhoneCode();
        $phoneCode->setCreateTime(time());
        $result = $phoneCode->fill($data)->save()->getResult();
        return $result ? $phoneCode : false;
    }

    /**
     * 更新验证码校验时间
     * @param int $type
     * @param string $phone
     * @param string $code
     * @return mixed
     */
    public function validatePhoneCode(int $type, string $phone, string $code)
    {
        return PhoneCode::updateOne(['validate_time' => time()], ['type' => $type, 'phone' => $phone, 'code' => $code, 'validate_time' => 0])->getResult();
    }

}
