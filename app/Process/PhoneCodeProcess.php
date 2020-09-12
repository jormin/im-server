<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-09
 * Time: 16:02
 */

namespace App\Process;


use App\Services\PhoneCodeService;
use Swoft\Bean\Annotation\Inject;
use Swoft\Core\Coroutine;
use Swoft\Process\Bean\Annotation\Process;
use Swoft\Process\Process as SwoftProcess;
use Swoft\Process\ProcessInterface;

/**
 * Class PhoneCodeProcess
 * @package App\Process
 * @Process(name="phoneCode", num=1)
 */
class PhoneCodeProcess implements ProcessInterface
{

    /**
     * @Inject()
     * @var PhoneCodeService 手机验证码Service
     */
    private $phoneCodeService;

    public function run(SwoftProcess $process)
    {
        $pname = \Swoft::$server->getPname();
        $processName = "$pname send phone code process";
        $process->name($processName);

        echo sprintf("发送短信验证码进程启动, Coroutine-id: %s \n", Coroutine::id());

        // 轮询处理客服分配
        while (true) {
            $this->phoneCodeService->dealPhoneCodeQueue();
        }
    }

    public function check(): bool
    {
        return true;
    }
}
