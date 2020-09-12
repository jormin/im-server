<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-09
 * Time: 13:55
 */

namespace App\Middlewares;


use App\Services\UserAuthService;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Inject;

/**
 * 鉴权中间件
 * @package App\Middlewares
 */
class AuthMiddleware implements MiddlewareInterface
{

    /**
     * @Inject()
     * @var UserAuthService 用户鉴权Service
     */
    private $userAuthService;

    /**
     * 鉴权处理
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine('token');
        if (!$token) {
            return response()->withStatus(403);
        }
        $decoded = $this->userAuthService->decodeAuthToken($token);
        if (!$decoded && $decoded['exp'] < time()) {
            return response()->withStatus(403);
        }
        $response = $handler->handle($request);
        return $response;
    }

}
