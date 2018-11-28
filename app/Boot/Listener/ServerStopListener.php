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

use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\ServerListener;
use Swoft\Bootstrap\Listeners\Interfaces\CloseInterface;
use Swoft\Bootstrap\Listeners\Interfaces\StartInterface;
use Swoft\Bootstrap\Listeners\Interfaces\WorkerStartInterface;
use Swoft\Bootstrap\SwooleEvent;
use Swoft\Process\ProcessBuilder;
use Swoole\Server;

/**
 * 监听服务启动
 * @package App\Listener
 * @ServerListener(event=SwooleEvent::ON_CLOSE, coroutine=true)
 */
class ServerStopListener implements CloseInterface
{

    function onClose(Server $server, int $fd, int $reactorId)
    {
        // 关闭聊天分配进程
        ProcessBuilder::get('imDistribute')->close();
        // 关闭聊天消息持久化进程
        ProcessBuilder::get('imMessagePersistence')->close();
    }

}
