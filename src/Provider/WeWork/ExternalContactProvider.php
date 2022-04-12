<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Provider\WeWork;

use Qxmcode\Framework\Contract\WeWork\ExternalContactConfigurable;

class ExternalContactProvider extends AbstractProvider
{
    /**
     * @var ExternalContactConfigurable
     */
    protected $service;

    /**
     * @return array app配置
     */
    protected function config(?string $wxCorpId = null, ?array $agentId = null): array
    {
        return $this->service->externalContactConfig($wxCorpId, $agentId);
    }
}
