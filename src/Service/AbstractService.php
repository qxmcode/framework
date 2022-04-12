<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Service;

abstract class AbstractService
{
    /**
     * @var \Hyperf\Database\Model\Model
     */
    protected $model;

    public function __construct()
    {
        $modelClass  = str_replace(['\Service', 'Service'], ['\Model', ''], get_class($this));
        $this->model = make($modelClass);
    }
}
