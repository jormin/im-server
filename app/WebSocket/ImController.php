<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\WebSocket;

use App\Lib\AuthInterface;
use App\Traits\SenderTrait;
use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Server\Response;
use Swoft\Redis\Redis;
use Swoft\WebSocket\Server\Bean\Annotation\WebSocket;
use Swoft\WebSocket\Server\HandlerInterface;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

/**
 * Class ImController - This is an controller for handle websocket
 * @package App\WebSocket
 * @WebSocket("/im")
 */
class ImController implements HandlerInterface
{

    use SenderTrait;

    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    protected $redis;

    /**
     * 频道成员缓存Key后缀
     * @var string
     */
    protected $channelMembersCacheSuffix = '_members';

    /**
     * 频道消息缓存Key后缀
     * @var string
     */
    protected $channelMessagesCacheSuffix = '_messages';

    /**
     * @var AuthInterface
     */
    protected $authService;

    /**
     * UID
     * @var
     */
    protected $uid;

    /**
     * 在这里你可以验证握手的请求信息
     * - 必须返回含有两个元素的array
     *  - 第一个元素的值来决定是否进行握手
     *  - 第二个元素是response对象
     * - 可以在response设置一些自定义header,body等信息
     * @param Request $request
     * @param Response $response
     * @return array
     * [
     *  self::HANDSHAKE_OK,
     *  $response
     * ]
     */
    public function checkHandshake(Request $request, Response $response): array
    {
        return [self::HANDSHAKE_OK, $response];
    }

    /**
     * @param Server $server
     * @param Request $request
     * @param int $fd
     * @return null
     */
    public function onOpen(Server $server, Request $request, int $fd)
    {
        return null;
    }

    /**
     * @param Server $server
     * @param Frame $frame
     * @return null
     */
    public function onMessage(Server $server, Frame $frame)
    {
        return null;
    }

    /**
     * @param Server $server
     * @param int $fd
     * @return null
     */
    public function onClose(Server $server, int $fd)
    {
        return null;
    }
}
