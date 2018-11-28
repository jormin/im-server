<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\WebSocket\Im;

use app\Common\CommonFunction;
use App\Lib\AuthInterface;
use App\Lib\KefuInterface;
use App\Models\Dao\KefuDao;
use App\Models\Entity\Kefu;
use App\Services\KefuAuthService;
use App\Services\KefuService;
use App\WebSocket\ImController;
use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Server\Response;
use Swoft\Redis\Redis;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\WebSocket\Server\Bean\Annotation\WebSocket;
use Swoft\WebSocket\Server\HandlerInterface;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

/**
 * Class KefuController - This is an controller for handle websocket
 * @package App\WebSocket
 * @WebSocket("/im/kefu")
 */
class KefuController extends ImController
{

    /**
     * @Inject()
     * @var KefuAuthService
     */
    protected $authService;

    /**
     * @Inject()
     * @var KefuService
     */
    protected $kefuService;

    /**
     * @Inject()
     * @var KefuDao
     */
    protected $kefuDao;

    /**
     * 握手校验
     * @param Request $request
     * @param Response $response
     * @return array
     */
    public function checkHandshake(Request $request, Response $response): array
    {
        $token = $request->query('token');
        $authResult = $this->authService->tokenLogin($token);
        if ($authResult === false) {
            return [self::HANDSHAKE_FAIL, $response];
        }
        $kefu = $authResult;
        $this->uid = $kefu->getId();
        $this->kefuService->online($kefu, $request->getSwooleRequest()->fd);
        return [self::HANDSHAKE_OK, $response];
    }

    /**
     * 成功建立连接
     * @param Server $server
     * @param Request $request
     * @param int $fd
     * @return null
     */
    public function onOpen(Server $server, Request $request, int $fd)
    {
        $kefu = $this->kefuService->getKefuByFd($fd);
        $message = '欢迎您，' . $kefu->getKefuName();
        $identityInfo = [
            'id' => $kefu->getId(),
            'name' => $kefu->getKefuName(),
            'gender' => $kefu->getKefuGender()
        ];
        $this->sendWelcomeMessage($fd, $message, $identityInfo);
        return null;
    }

    /**
     * 客服发送消息
     * @param Server $server
     * @param Frame $frame
     * @return null
     */
    public function onMessage(Server $server, Frame $frame)
    {
        $fd = $frame->fd;
        $kefu = $this->kefuService->getKefuByFd($fd);
        // 收到消息后先回复保持心跳
        $this->sendGMMessage($frame->fd, 3, 'ok');
        $data = json_decode($frame->data, true);
        if ($data['type'] == -1) {
            return null;
        }
        $this->kefuService->sendMessage($kefu, $fd, $data);
        return null;
    }

    /**
     * 客服断开连接
     * @param Server $server
     * @param int $fd
     * @return null
     */
    public function onClose(Server $server, int $fd)
    {
        $kefu = $this->kefuService->getKefuByFd($fd);
        $this->kefuService->offline($kefu, $fd);
        return null;
    }
}
