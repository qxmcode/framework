<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Middleware;

use Hyperf\Contract\ConfigInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Qxmcode\Framework\Middleware\Traits\Route;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 格式化响应数据
 * Class ResponseMiddleware.
 */
class ResponseMiddleware implements MiddlewareInterface
{
    use Route;

    /**
     * @var string 路由白名单
     */
    protected $responseRawRoutes;

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container, ConfigInterface $config)
    {
        $this->container         = $container;
        $this->responseRawRoutes = $config->get('framework.response_raw_routes', []);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        if ($this->whiteListAuth($this->responseRawRoutes)) {
            return $response;
        }
        return $this->formatStream($response);
    }

    protected function formatStream(ResponseInterface $response): ResponseInterface
    {
        $oldStream  = json_decode($response->getBody()->getContents(), true) ?? [];
        $httpCode   = $response->getStatusCode();
        $formatData = responseDataFormat($httpCode, '', $oldStream);

        $newStream = new SwooleStream(json_encode($formatData, JSON_UNESCAPED_UNICODE));
        return $response->withBody($newStream);
    }
}
