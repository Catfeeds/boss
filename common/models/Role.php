<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property integer $role_id
 * @property string $role_name
 * @property integer $role_owner
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_owner'], 'integer'],
            [['role_name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => Yii::t('app', 'Role ID'),
            'role_name' => Yii::t('app', 'Role Name'),
            'role_owner' => Yii::t('app', 'Role Owner'),
        	'owner.owner_name' => Yii::t('app', 'Role Owner'),
        ];
    }
    
    public function getOwner()
    {
    	return $this->hasOne(Owner::className(), ['owner_id'=>'role_owner']);
    }
    
    public function getPrivilege()
    {
    	return $this->hasMany(Privilege::className(), ['privilege_role'=>'role_id']);
    }
}
