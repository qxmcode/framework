<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Contract\WeWork;

interface AppConfigurable
{
    public function appConfig(?string $wxCorpId = null, ?array $agentId = null): array;
}
