<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%privilege}}".
 *
 * @property integer $privilege_id
 * @property integer $privilege_action
 * @property integer $privilege_role
 */
class Privilege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%privilege}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['privilege_action', 'privilege_role'], 'required'],
            [['privilege_action', 'privilege_role'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'privilege_id' => Yii::t('app', 'Privilege ID'),
            'privilege_action' => Yii::t('app', 'Privilege Action'),
            'privilege_role' => Yii::t('app', 'Privilege Role'),
        ];
    }
    
    public function getAction()
    {
    	return $this->hasOne(Action::className(), ['action_id'=>'privilege_action']);
    }
    
    public function getRole()
    {
    	return $this->hasOne(Role::className(), ['role_id'=>'privilege_role']);
    }
}
