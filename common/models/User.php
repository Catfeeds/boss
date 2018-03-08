<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_wgid
 * @property string $user_wxid
 * @property string $user_number
 * @property string $user_pswd
 * @property integer $user_remember
 * @property integer $user_group
 * @property integer $user_curdevice
 * @property integer $user_app
 * @property string $user_create
 * @property string $user_login
 * @property string $user_token
 * @property integer $user_enabled
 * @property string $user_lang
 * @property string $user_nick
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_wgid', 'user_wxid', 'user_number', 'user_pswd', 'user_remember', 'user_curdevice', 'user_app', 'user_token', 'user_nick'], 'required'],
            [['user_remember', 'user_group', 'user_curdevice', 'user_app', 'user_enabled'], 'integer'],
            [['user_create', 'user_login'], 'safe'],
            [['user_name', 'user_number'], 'string', 'max' => 20],
            [['user_wgid', 'user_wxid', 'user_pswd', 'user_token'], 'string', 'max' => 128],
            [['user_lang'], 'string', 'max' => 5],
            [['user_nick'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'user_wgid' => Yii::t('app', 'User Wgid'),
            'user_wxid' => Yii::t('app', 'User Wxid'),
            'user_number' => Yii::t('app', 'User Number'),
            'user_pswd' => Yii::t('app', 'User Pswd'),
            'user_remember' => Yii::t('app', 'User Remember'),
            'user_group' => Yii::t('app', 'User Group'),
            'user_curdevice' => Yii::t('app', 'User Curdevice'),
            'user_app' => Yii::t('app', 'User App'),
            'user_create' => Yii::t('app', 'User Create'),
            'user_login' => Yii::t('app', 'User Login'),
            'user_token' => Yii::t('app', 'User Token'),
            'user_enabled' => Yii::t('app', 'User Enabled'),
            'user_lang' => Yii::t('app', 'User Lang'),
            'user_nick' => Yii::t('app', 'User Nick'),
        ];
    }
    
    public function getBind()
    {
    	return $this->hasMany(Bind::className(), ['bind_user'=>'user_id']);
    }
}
