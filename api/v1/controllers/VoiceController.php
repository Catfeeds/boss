<?php 
namespace app\api\v1\controllers;

use \yii\rest\ActiveController;

class VoiceController extends ActiveController
{
	public $modelClass = 'app\common\models\Voice';
	
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
			
			$devObj = \app\common\models\Device::findOne($device);
			if( !$devObj ){
				return [];
			}
			
			$query = $query->where(['like', 'voice_to', $devObj->device_imei])->orWhere(['like', 'voice_from', $devObj->device_imei]);
		}
		
		return \Yii::createObject([
				'class' => \yii\data\ActiveDataProvider::className(),
				'query' => $query
		]);
	}
}

?>