<?php 
namespace app\api\v1\controllers;

use \yii\rest\ActiveController;

class AlarmController extends ActiveController
{
	public $modelClass = 'app\common\models\Alarm';
	
	public function actions()
	{
		$actions = parent::actions();
		$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
		return $actions;
	}
	
	public function prepareDataProvider()
	{
		$modelClass = $this->modelClass;
		$query = $modelClass::find();
		
		$device = \Yii::$app->getRequest()->get('device');
				
		if( $device !== null ){			
			$query = $query->where(['clock_device'=>$device]);
		}
		
		return \Yii::createObject([
				'class' => \yii\data\ActiveDataProvider::className(),
				'query' => $query
		]);
	}
}

?>