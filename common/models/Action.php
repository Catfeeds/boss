<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%action}}".
 *
 * @property integer $action_id
 * @property string $action_name
 * @property string $action_match
 * @property string $action_type
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%action}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_name'], 'string', 'max' => 32],
            [['action_match'], 'string', 'max' => 64],
            [['action_type'], 'string', 'max' => 16],
        	[['action_parent'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'action_id' => Yii::t('app', 'Action ID'),
            'action_name' => Yii::t('app', 'Action Name'),
            'action_match' => Yii::t('app', 'Action Match'),
            'action_type' => Yii::t('app', 'Action Type'),
        	'action_parent' => Yii::t('app', 'Action Parent'),
        	'parent.action_name' => Yii::t('app', 'Action Parent'),
        ];
    }
    
    public function getPrivilege()
    {
    	return $this->hasMany(Privilege::className(), ['privilege_action'=>'action_id']);
    }
    
    public function getParent()
    {
    	return $this->hasOne(Action::className(), ['action_id'=>'action_parent']);
    }
}
