<?php 

namespace app\admin\controllers;

class DefaultController extends \yii\web\Controller {	
	public function actionIndex(){
		if( \Yii::$app->user->isGuest ){
			return \Yii::$app->user->loginRequired();
		}
		return $this->render('index');
	}
	
	public function actionLogin(){
		$model = new \app\common\models\Login();
		
		if( $model->load(\Yii::$app->getRequest()->post(), "") ){
			$pswd = md5($model->password);
			$identity = \app\common\models\Operator::loginIdentify(['operator_name'=>$model->username, 'operator_pswd'=>$pswd]);
			if( $identity ){
				\Yii::$app->user->login($identity);
				$this->goBack('index.php?r=admin');
			}
		}
		return $this->render('login');
	}
	
	public function actionLogout(){
		\Yii::$app->user->logout();
		$this->redirect(['login']);
	}
}

?>