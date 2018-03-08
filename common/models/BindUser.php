<?php 
namespace app\common\models;

class BindUser extends User
{
	public $bind_nick;
	
	public function fields()
	{
		return array_merge(parent::fields(), ['bind_nick'=>'bind_nick']);
	}
	
	public static function find()
	{
		$query = \Yii::createObject(\yii\db\ActiveQuery::className(), [get_called_class()]);
		return $query->joinWith(['bind']);
	}
}
?>