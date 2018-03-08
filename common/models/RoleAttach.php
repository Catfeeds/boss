<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%role_attach}}".
 *
 * @property integer $role_attach_id
 * @property integer $role_attach_operator
 * @property integer $role_attach_role
 */
class RoleAttach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role_attach}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_attach_operator', 'role_attach_role'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_attach_id' => Yii::t('app', 'Role Attach ID'),
            'role_attach_operator' => Yii::t('app', 'Role Attach Operator'),
            'role_attach_role' => Yii::t('app', 'Role Attach Role'),
        ];
    }
    
    public function getRole()
    {
    	return $this->hasOne(Role::className(), ['role_id'=>'role_attach_role']);
    }
    
    public function getOperator()
    {
    	return $this->hasOne(Operator::className(), ['operator_id'=>'role_attach_operator']);	
    }
}
