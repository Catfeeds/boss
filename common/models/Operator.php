<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "zlt_operator".
 *
 * @property integer $operator_id
 * @property string $operator_name
 * @property string $operator_pswd
 */
class Operator extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zlt_operator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operator_name', 'operator_pswd'], 'required'],
            [['operator_name'], 'string', 'max' => 32],
            [['operator_pswd'], 'string', 'max' => 128],
            [['operator_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'operator_id' => Yii::t('app', 'Operator ID'),
            'operator_name' => Yii::t('app', 'Operator Name'),
            'operator_pswd' => Yii::t('app', 'Operator Pswd'),
        	'attach.role.role_name' => Yii::t('app', 'Operator Role'),
        ];
    }
    
    public function getAttach()
    {
    	return $this->hasMany(RoleAttach::className(), ['role_attach_operator'=>'operator_id']);
    }
    
    public static function findIdentity($id)
    {
    	return \app\common\models\Operator::find()->where(['operator_id'=>$id])->one();
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	\Yii::trace('UserToken::findIdentityByAccessToken '.$token);
    }
    
    public function getTokenUser()
    {
    	return $this;
    }
    
    public function getId()
    {
    	return $this->operator_id;
    }
    
    public function getAuthKey()
    {
    	\Yii::trace('UserToken::getAuthKey');
    }
    
    public function validateAuthKey($authKey)
    {
    	\Yii::trace('UserToken::validateAuthKey '.$authKey);
    }
    
    public static function loginIdentify($params)
    {
    	return \app\common\models\Operator::find()->where($params)->one();
    }
}
