<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-09
 * Time: 15:16
 */

namespace App\Services;


use app\Common\CommonFunction;
use App\Models\Dao\PhoneCodeDao;
use Jormin\Aliyun\Sms;
use Swoft\Bean\Annotation\Inject;
use Swoft\Rpc\Server\Bean\Annotation\Service;

/**
 * 手机验证码Service
 * @package App\Services
 * @Service()
 */
class PhoneCodeService extends BaseService
{

    const REGISTER = 0;
    const RESET = 1;
    const MODIFY = 2;

    private static $templateCodeKeys = ['registerCode', 'resetPasswordCode', 'modifyPasswordCode'];

    private $phoneCodeQueueName = 'phone_code_queue';

    /**
     * @Inject()
     * @var PhoneCodeDao 验证码处理Dao
     */
    private $phoneCodeDao;

    /**
     * 发送验证码
     * @param int $type
     * @param string $phone
     * @return array
     */
    public function sendCode(int $type, string $phone)
    {
        $cacheKey = $this->getCacheKey($type, $phone);
        $expireTime = intval(CommonFunction::getCustomConfig('phoneCodeExpire'));
        $code = CommonFunction::getRandChar(4, false);
        if ($this->redis->has($cacheKey)) {
            return $this->failed('上次获取的验证码尚未过期');
        }
        // 验证码存库
        $phoneCode = $this->phoneCodeDao->createPhoneCode([
            'type' => $type,
            'phone' => $phone,
            'code' => $code,
            'expire_time' => time() + $expireTime
        ]);
        if (!$phoneCode) {
            return $this->failed('记录验证码失败');
        }
        // 验证码存缓存
        $this->redis->setEx($cacheKey, $code, $expireTime);
        // 添加到验证码发送队列
        $this->redis->lPush($this->phoneCodeQueueName, $type . '_' . $phone . '_' . $code);
        return $this->success('发送验证码成功', ['expireTime' => $expireTime]);
    }

    /**
     * 校验验证码
     * @param int $type
     * @param string $phone
     * @param string $code
     * @return array
     */
    public function validateCode(int $type, string $phone, string $code){
        $cacheKey = $this->getCacheKey($type, $phone);
        if (!$this->redis->has($cacheKey)) {
            return $this->failed('验证码不存在或已过期');
        }
        $cacheCode = $this->redis->get($cacheKey);
        if($cacheCode !== $code){
            return $this->failed('验证码错误');
        }
        $result = $this->phoneCodeDao->validatePhoneCode($type, $phone, $code);
        if(!$result){
            return $this->failed('更新验证码校验时间失败');
        }
        $this->redis->delete($cacheKey);
        return $this->success('验证码正确');
    }

    /**
     * 处理发送短信队列
     * @return array
     */
    public function dealPhoneCodeQueue()
    {
        $job = $this->redis->rPop($this->phoneCodeQueueName);
        if (!$job) {
            return $this->failed('暂无任务执行');
        }
        $queueArr = explode('_', $job);
        $type = $queueArr[0];
        $phone = $queueArr[1];
        $code = $queueArr[2];
        $aliyunConfig = CommonFunction::getCustomConfig('aliyun');
        $templateCode = $aliyunConfig[self::$templateCodeKeys[$type]];
        $sms = new Sms($aliyunConfig['accessKeyId'], $aliyunConfig['accessKeySecret']);
        $response = $sms->sendSms($phone, $aliyunConfig['signature'], $templateCode, ['code' => $code]);
        if (!$response['success']) {
            return $this->failed($response['message']);
        }
        return $this->success('发送验证码成功');
    }

    /**
     * 获取缓存键名
     * @param $type
     * @param $phone
     * @return string
     */
    private function getCacheKey($type, $phone)
    {
        return 'phone_code_type_' . $type . '_phone_' . $phone;
    }

}
