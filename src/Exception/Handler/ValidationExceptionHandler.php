<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Qxmcode\Framework\Constants\ErrorCode;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();

        /** @var \Hyperf\Validation\ValidationException $throwable */
        $falseMsg = $throwable->validator->errors()->first();

        ## 格式化输出
        $data = responseDataFormat(ErrorCode::INVALID_PARAMS, $falseMsg);

        $dataStream = new SwooleStream(json_encode($data, JSON_UNESCAPED_UNICODE));

        return $response->withAddedHeader('Content-Type', 'application/json;charset=utf-8')
            ->withStatus($throwable->status)
            ->withBody($dataStream);
    }

    public function isValid(Throwable $throwable): bool
    {
        $validateException = \Hyperf\Validation\ValidationException::class;
        if (class_exists($validateException) && $throwable instanceof $validateException) {
            return true;
        }
        return false;
    }
}
