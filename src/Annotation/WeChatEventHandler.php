<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * 微信回调事件处理器收集.
 * @Annotation
 * @Target({"CLASS"})
 */
class WeChatEventHandler extends AbstractAnnotation
{
    /**
     * @var string 事件路径，组成参数为: MsgType[/Event[/ChangeType|EventKey]]
     */
    public $eventPath = '';

    /**
     * @var int 注册顺序
     */
    public $sort = 99;
}
