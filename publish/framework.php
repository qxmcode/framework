<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
return [
    // Qxmcode\Framework\Middleware\JwtAuthMiddleware jwt路由验证白名单
    'auth_white_routes' => [
        '/user/auth', '/weWork/callback',
    ],

    // Qxmcode\Framework\Middleware\ResponseMiddleware 原生响应格式的路由
    'response_raw_routes' => [
        '/weWork/callback',
    ],

    'wework' => [
        'config' => [
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            'log' => [
                'level' => 'debug',
                'file'  => BASE_PATH . '/runtime/logs/wechat.log',
            ],
        ],
        'default' => [
            'provider' => 'app',
        ],
        'providers' => [
            'app' => [
                'name'    => \Qxmcode\Framework\Provider\WeWork\AppProvider::class,
                'service' => App\Model\Corp::class, //  需要实现 Qxmcode\Framework\Contract\WeWork\AppConfigurable 接口
            ],
            'user' => [
                'name'    => \Qxmcode\Framework\Provider\WeWork\UserProvider::class,
                'service' => App\Model\Corp::class, //  需要实现 Qxmcode\Framework\Contract\WeWork\UserConfigurable 接口
            ],
            'externalContact' => [
                'name'    => \Qxmcode\Framework\Provider\WeWork\ExternalContactProvider::class,
                'service' => App\Model\Corp::class, //  需要实现 Qxmcode\Framework\Contract\WeWork\ExternalContactConfigurable 接口
            ],
            'agent' => [
                'name'    => \Qxmcode\Framework\Provider\WeWork\AgentProvider::class,
                'service' => App\Model\Corp::class, //  需要实现 Qxmcode\Framework\Contract\WeWork\AgentConfigurable 接口
            ],
        ],
    ],
];
