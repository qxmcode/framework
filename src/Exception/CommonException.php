<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Exception;

use Hyperf\Server\Exception\ServerException;
use Qxmcode\Framework\Constants\ErrorCode;

class CommonException extends ServerException
{
    public function __construct(int $code = 0, string $message = null, \Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
            if (! $message && class_exists(\App\Constants\AppErrCode::class)) {
                $message = \App\Constants\AppErrCode::getMessage($code);
            }
        }
        parent::__construct($message, $code, $previous);
    }
}
