<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Process;

use App\Services\ImService;
use Swoft\Bean\Annotation\Inject;
use Swoft\Core\Coroutine;
use Swoft\Process\Bean\Annotation\Process;
use Swoft\Process\Process as SwoftProcess;
use Swoft\Process\ProcessInterface;

/**
 *
 * Class ImMessagePersistenceProcess - Custom process
 *
 * @Process(name="imMessagePersistence", coroutine=true)
 * @package App\Process
 */
class ImMessagePersistenceProcess implements ProcessInterface
{

    /**
     * @Inject()
     * @var ImService
     */
    private $imService;

    public function run(SwoftProcess $process)
    {
        $pname = \Swoft::$server->getPname();
        $processName = "$pname im message persistence process";
        $process->name($processName);

        echo sprintf("聊天消息持久化进程启动, Coroutine-id: %s \n", Coroutine::id());

        // 轮询处理客服分配
        while (true) {
            $this->imService->persistence();
        }
    }

    public function check(): bool
    {
        return true;
    }
}
