<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'language' => 'pt-br',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
    'controllerMap' => [
        'batch' => [
            'class' => 'schmunk42\giiant\commands\BatchController',
            'overwrite' => true,
            'modelNamespace' => 'app\\models',
            'modelQueryNamespace' => 'app\\models\\query',
            'crudControllerNamespace' => 'app\\controllers',
            'crudSearchModelNamespace' => 'app\\models\\search',
            'crudViewPath' => '@app/views',
            'crudPathPrefix' => '',
            'crudTidyOutput' => true,
            'crudAccessFilter' => true,
            'crudProviders' => [
                'schmunk42\\giiant\\generators\\crud\\providers\\optsProvider',
            ],
            //'tablePrefix' => 'app_',
            /*'tables' => [
                'app_profile',
            ]*/
        ]
],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
