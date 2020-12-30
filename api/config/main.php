<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@api/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCookieValidation' => true,
            'cookieValidationKey' => 'bargest',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/table',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET accounts/{id}' => 'table_accounts',
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/request',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET current' => 'current_requests',
                        'GET info/{id}' => 'info',
                        'DELETE delete/{id}' => 'delete_request',
                        'POST create/account/{id}' => 'create_requestinaccount',
                        'POST create/table/{id}' => 'create_requestintable',
                        'PUT edit/{id}' => 'request_edit',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/category',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET all' => 'category',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/product',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET category/{id}' => 'get_porducts_by_category',
                        'GET all' => 'getall',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/account',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET info/{id}' => 'accountinfo',
                        'PUT pay/{id}' => 'pay',
                        'PUT splitpay/{id}' => 'splitpay',
                    ],
                ]
            ],        
        ]
    ],
    'params' => $params,
];



