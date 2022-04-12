<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Event;

class PluginEvent
{
    /**
     * @var null|string|string[]
     */
    protected $package;

    /**
     * @var null|string|string[]
     */
    protected $version;

    public function __construct(array $config)
    {
        [$this->package, $this->version] = $config;
    }

    /**
     * 获取插件包名称.
     * @return string ...
     */
    public function getPackage(): string
    {
        return $this->package;
    }

    /**
     * 获取插件包版本.
     * @return string ...
     */
    public function getVersion(): string
    {
        return $this->package;
    }
}
