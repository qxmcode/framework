<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Middleware;

use Hyperf\Utils\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $originConfig = config('framework.cors_origin', '*');
        $origin       = 'null';
        if ($originConfig === '*') {
            $origin = '*';
        } else {
            $originReq                                                         = $request->getHeaderLine('Origin');
            in_array($originReq, explode(',', $originConfig), true) && $origin = $originReq;
        }

        $response = Context::get(ResponseInterface::class);
        $response = $response->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader(
                'Access-Control-Allow-Headers',
                'Authorization,Accept,Content-Type,Origin,User-Agent,X-Requested-With,Qxmcode-Corp-Id,Qxmcode-Source-Type'
            )
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');

        Context::set(ResponseInterface::class, $response);

        if (strtoupper($request->getMethod()) === 'OPTIONS') {
            return $response;
        }

        return $handler->handle($request);
    }
}
