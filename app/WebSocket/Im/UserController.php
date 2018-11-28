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
use App\Models\Dao\UserDao;
use App\Models\Entity\User;
use App\Services\UserAuthService;
use App\Services\UserService;
use App\WebSocket\ImController;
use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Server\Response;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Redis\Redis;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\WebSocket\Server\Bean\Annotation\WebSocket;
use Swoft\WebSocket\Server\HandlerInterface;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

/**
 * Class UserController - This is an controller for handle websocket
 * @package App\WebSocket
 * @WebSocket("/im/user")
 * @Controller()
 */
class UserController extends ImController
{

    /**
     * @Inject()
     * @var UserAuthService
     */
    protected $authService;

    /**
     * @Inject()
     * @var UserService
     */
    protected $userService;

    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

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
        if($authResult === false){
            return [self::HANDSHAKE_FAIL, $response];
        }
        $user = $authResult;
        $this->uid = $user->getId();
        $this->userService->online($user, $request->getSwooleRequest()->fd);
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
        $user = $this->userService->getUserByFd($fd);
        $message = '欢迎您，' . $user->getUserName();
        $identityInfo = [
            'id' => $user->getId(),
            'name' => $user->getUserName(),
            'gender' => $user->getUserGender(),
            'avatar' => $user->getUserAvatar(),
        ];
        $this->sendWelcomeMessage($fd, $message, $identityInfo);
        // 用户排队
        $this->userService->waiting($fd);
        return null;
    }

    /**
     * 用户发送消息
     * @param Server $server
     * @param Frame $frame
     * @return null
     */
    public function onMessage(Server $server, Frame $frame)
    {
        $fd = $frame->fd;
        $user = $this->userService->getUserByFd($fd);
        // 收到消息后先回复保持心跳
        $this->sendGMMessage($frame->fd, 3, 'ok');
        $data = json_decode($frame->data, true);
        if ($data['type'] === -1) {
            return null;
        }
        $this->userService->sendMessage($user, $fd, $data);
        return null;
    }

    /**
     * 用户断开连接
     * @param Server $server
     * @param int $fd
     * @return null
     */
    public function onClose(Server $server, int $fd)
    {
        $user = $this->userService->getUserByFd($fd);
        $this->userService->offline($user, $fd);
        return null;
    }
}
