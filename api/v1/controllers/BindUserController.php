<?php 
namespace app\api\v1\controllers;

use \yii\rest\ActiveController;

class BindUserController extends ActiveController
{
	public $modelClass = 'app\common\models\BindUser';
	
	public function actions()
	{
		$actions = parent::actions();
		$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
		return $actions;
	}
	
	public function prepareDataProvider()
	{
		$modelClass = $this->modelClass;
		$query = $modelClass::find()->addSelect(['user_id', 'user_name', 'user_nick', 'bind_nick'])->where(['bind_valid'=>1]);
		
		$device = \Yii::$app->getRequest()->get('device');
		
		if( !$device ){
			return [];
		}
							
		$query = $query->where(['bind_device'=>$device]);
		
		return \Yii::createObject([
				'class' => \yii\data\ActiveDataProvider::className(),
				'query' => $query
		]);
	}
}

?>