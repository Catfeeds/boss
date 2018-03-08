<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once(__DIR__."/vendor/autoload.php");
require_once(__DIR__."/vendor/yiisoft/yii2/Yii.php");

$config = [
		'id' => 'app',
		'basePath' => __DIR__,
		'bootstrap' =>[
				'log'
		],
		
		'components' => [
				'log' => [
						'targets' => [
								[
										'class' => 'yii\log\FileTarget',
										'levels' =>[
												'trace','info','profile','warning','error'
										]
								]
						]
				],
				'request' => [
						'cookieValidationKey' => '12345678',
						'parsers' => [
								'application/json' => 'yii\web\JsonParser',
						]
				],
				'db' => require('config/db.php'),				
				'user' => [
						'identityClass' => 'app\common\models\Operator',
						'enableAutoLogin' => true,
				],
		],
		'modules' => [
				'admin' => [
						'class' => 'app\admin\Module',
				],
				'api' => [
						'class' => 'app\api\Module',
				]
		],
];

if( is_file(__DIR__.'/config/modules.php')){
	$config['modules'] = array_merge($config['modules'], require(__DIR__.'/config/modules.php'));
}

$application = new yii\web\Application($config);

\Yii::setAlias('@bower', '@vendor/bower-asset');

$application->run();
?>
