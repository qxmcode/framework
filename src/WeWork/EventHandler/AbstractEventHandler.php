<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\WeWork\EventHandler;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use EasyWeChat\Kernel\Messages\Message;

abstract class AbstractEventHandler implements EventHandlerInterface
{
    /**
     * @var array wx请求消息
     */
    protected $message;

    /**
     * @var bool 是否停止传递 handler
     */
    private $propagationStatus = false;

    /**
     * @param null $payload wx请求消息
     * @return null|bool|mixed wx响应消息
     */
    public function handle($payload = null)
    {
        $this->message = $payload;
        $processData   = $this->process();

        if ($this->propagationStatus) {
            return false;
        }
        return $processData;
    }

    /**
     * @return int 参数必须是 \EasyWeChat\Kernel\Messages\Message 类的常量
     */
    public static function handlerType(): int
    {
        return Message::ALL;
    }

    /**
     * 微信消息处理.
     * @return null|mixed 推送到微信的消息
     */
    abstract public function process();

    protected function stopPropagation(bool $status = true): bool
    {
        return $this->propagationStatus = $status;
    }
}
