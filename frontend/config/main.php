<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
         'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<goods>/<controller:category>/<action:search>/<query>' => '<module>/<controller>/<action>',
                'sitemap.xml' => 'sitemap/index',
                [
                    'pattern' => 'links',
                    'route' => 'office/office/links',
                    'suffix' => '.php',
                ],
                [
                    'pattern' => 'links<slug:\d+>',
                    'route' => 'office/office/index',
                    'suffix' => '.php',
                ],
                [
                    'pattern' => 'news',
                    'route' => 'post/post/category',
                ],

                [
                    'pattern' => 'reviews/<slug:Otzyvy>',
                    'route' => 'office/office/category',
                ],
                [
                    'pattern' => '<slug:\w+>',
                    'route' => 'office/office/index',
                ],
                [
                    'pattern' => 'order/<id:(\d+(%%(\d+))*)>',
                    'route' => 'office/office/index',
                ],
                [
                    'pattern' => '<slug:(\w+(-(\w+))+)>',
                    'route' => 'office/office/index',
                ],
                [
                    'pattern' => 'news/<id>',
                    'route' => 'post/post/onepost',
                ],
                [
                    'class' => 'frontend\components\GodsUrlRule',
                ],
            ]
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => ['css/bootstrap.min.css'],
                ],
            ],
            'converter'=> [
                'class'=> 'nizsheanez\assetConverter\Converter',
                'force'=> false, // true : If you want convert your sass each time without time dependency
                'destinationDir' => 'compiled', //at which folder of @webroot put compiled files
                'parsers' => [
                    'sass' => [ // file extension to parse
                        'class' => 'nizsheanez\assetConverter\Sass',
                        'output' => 'css', // parsed output file type
                        'options' => [
                            'cachePath' => '@app/runtime/cache/sass-parser' // optional options
                        ],
                    ],
                    'scss' => [ // file extension to parse
                        'class' => 'nizsheanez\assetConverter\Sass',
                        'output' => 'css', // parsed output file type
                        'options' => [] // optional options
                    ],
                    'less' => [ // file extension to parse
                        'class' => 'nizsheanez\assetConverter\Less',
                        'output' => 'css', // parsed output file type
                        'options' => [
                            'auto' => true, // optional options
                        ]
                    ]
                ]
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ''
        ],
        /*'user' => [
            'identityCookie' => [
                'name'     => '_frontendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'FRONTENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
        ],*/

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'nodeSocket' => [
            'class' => '\YiiNodeSocket\NodeSocket',
            'host' => 'localhost',
            'allowedServerAddresses' => [
                "localhost",
                "127.0.0.1"
            ],
            'origin' => '*:*',
            'sessionVarName' => 'PHPSESSID',
            'port' => 3001,
            'socketLogFile' => '/var/log/node-socket.log',
        ],
    ],

    'modules' => [
        'search' => [
            'class' => 'frontend\modules\search\Module',
        ],
        'user' => [
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
            'controllerMap' => [
                'admin' => 'frontend\controllers\SettingsController'
            ],
        ],
        'gods' => [
            'class' => 'frontend\modules\gods\Module',
        ],
        'post' => [
            'class' => 'frontend\modules\post\Module',
        ],
        'cart' => [
            'class' => 'frontend\modules\cart\Module',
        ],
        'office' => [
            'class' => 'frontend\modules\office\Module',
        ],
    ],
    'params' => $params,
];