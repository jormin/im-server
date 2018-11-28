<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Boot\Listener;

use Swoft\Bean\Annotation\ServerListener;
use Swoft\Bootstrap\Listeners\Interfaces\StartInterface;
use Swoft\Bootstrap\Listeners\Interfaces\WorkerStartInterface;
use Swoft\Bootstrap\SwooleEvent;
use Swoft\Process\ProcessBuilder;
use Swoole\Server;

/**
 * 监听服务启动
 * @package App\Listener
 * @ServerListener(event=SwooleEvent::ON_WORKER_START, coroutine=true)
 */
class ServerStartListener implements WorkerStartInterface
{
    public function onWorkerStart(Server $server, int $workerId, bool $isWorker)
    {
        if($workerId === 0 && $isWorker){
            // 启动聊天分配进程
            ProcessBuilder::create('imDistribute')->start();
            // 启动聊天消息持久化进程
            ProcessBuilder::create('imMessagePersistence')->start();
        }
    }


}
