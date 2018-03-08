<?php 

namespace app\api\v1\controllers;

use yii\rest\Controller;

class DeviceControlController extends Controller
{
	protected function performAction($device, $uri, $method='POST')
	{
		$control = new \app\common\components\DeviceControl();
		
		if( $method=='POST'){
			return $control->post($device, $uri);
		}
		
		return $control->get($device, $uri);
	}
	
	public function actionLocation($device)
	{
		$result = $this->performAction($device, "/loc");
		
		return json_decode($result);
	}
	
	public function actionMonitor($device, $phone)
	{
		$this->performAction($device, "/monitor/$phone");
		\Yii::$app->getResponse()->setStatusCode(204);
	}
	
	public function actionTakePhoto($device, $phone, $sid)
	{
		$this->performAction($device, "/takephoto/$phone/$sid");
		\Yii::$app->getResponse()->setStatusCode(204);
	}
	
	public function actionFind($device)
	{
		$this->performAction($device, '/find');
		\Yii::$app->getResponse()->setStatusCode(204);		
	}
	
	public function actionShutdown($device)
	{
		$this->performAction($device, '/shutdown');
		\Yii::$app->getResponse()->setStatusCode(204);
	}
	
	public function actionReset($device)
	{
		$this->performAction($device, '/reset');
		\Yii::$app->getResponse()->setStatusCode(204);
	}
	
	public function actionFactory($device)
	{
		$this->performAction($device, '/factory');
		\Yii::$app->getResponse()->setStatusCode(204);
	}
	
	public function actionSyncPhonebook($device)
	{
		$this->performAction($device, '/phonebook');
		$this->performAction($device, '/family');
		\Yii::$app->getResponse()->setStatusCode(204);
	}
	
	public function actionSyncNodisturb($device)
	{
		$this->performAction($device, '/nodisturb');
		\Yii::$app->getResponse()->setStatusCode(204);
	}
	
	public function actionSyncAlarm($device)
	{
		$this->performAction($device, '/alarm');
		\Yii::$app->getResponse()->setStatusCode(204);
	}
	
	public function actionInfo($device)
	{
		$result = $this->performAction($device, '', 'GET');
		
		return json_decode($result);
	}
	
	public function actionHost($device)
	{
		$result = $this->performAction($device, '/host', 'GET');
		
		return json_decode($result);
	}
	
	public function actionEcho($device)
	{
		$result = $this->performAction($device, '/echo', 'POST');
		
		return json_decode($result);
	}
}

?>