<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2019-01-09
 * Time: 13:57
 */

namespace App\Middlewares;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;

/**
 * 跨域中间件
 * @package App\Middlewares
 * @Bean()
 */
class CorsMiddleware implements MiddlewareInterface
{

    /**
     * 跨域中间件处理
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if('OPTIONS' === $request->getMethod()){
            return $this->corsConfig(response());
        }
        $this->corsConfig(response());
        $response = $handler->handle($request);
        $response = $this->corsConfig($response);
        return $response;
    }

    /**
     * 跨域设置
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    private function corsConfig(ResponseInterface $response){
        return $response->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, Auth-Token')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    }

}
