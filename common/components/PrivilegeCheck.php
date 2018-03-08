<?php 
namespace app\common\components;

use Yii;
use \yii\base\ActionFilter;
use \yii\helpers\ArrayHelper;

class PrivilegeCheck extends ActionFilter
{
	public function beforeAction($action)
	{
		if( Yii::$app->user->isGuest ){
			Yii::$app->user->loginRequired();
			return false;
		}
				
		$operator = Yii::$app->user->getIdentity();
		
		$roles = ArrayHelper::getColumn($operator->attach, 'role_attach_role');
		
		if( !in_array(1, $roles) ){			
			$privilege = \app\common\models\Action::find()->joinWith(['privilege'])->where(['action_match'=>$action->getUniqueId()])->andWhere(['in', 'privilege_role', $roles])->one();
			
			if( !$privilege ){
				throw new \yii\web\ForbiddenHttpException();
			}
		}
				
		return parent::beforeAction($action);
	}
}

?>