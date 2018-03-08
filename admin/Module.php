<?php
namespace app\admin;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\admin\controllers';
	public $layoutPath = 'admin';
	public $layout = 'default';
	
	public function init()
	{
		parent::init();
		\Yii::$app->user->loginUrl = 'index.php?r=admin/default/login';
	}
}

?>
