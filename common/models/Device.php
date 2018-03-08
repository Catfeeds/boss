<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%device}}".
 *
 * @property integer $device_id
 * @property string $device_imei
 * @property string $device_card
 * @property string $device_phone
 * @property string $device_name
 * @property integer $device_master
 * @property integer $device_status
 * @property integer $device_debug
 * @property integer $device_position
 * @property integer $device_app
 * @property integer $device_owner
 * @property integer $device_type
 * @property string $device_create_time
 * @property integer $device_enabled
 * @property integer $device_cardsupply
 * @property string $board_model
 * @property string $product_name
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%device}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_imei', 'device_owner', 'device_type'], 'required'],
            [['device_master', 'device_status', 'device_debug', 'device_position', 'device_app', 'device_owner', 'device_type', 'device_enabled', 'device_cardsupply'], 'integer'],
        	[['device_create_time','device_phone', 'board_model', 'product_name'], 'safe'],
            [['device_imei', 'device_phone', 'device_name'], 'string', 'max' => 24],
            [['device_card'], 'string', 'max' => 32],
            [['board_model', 'product_name'], 'string', 'max' => 100],
            [['device_imei'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'Device ID'),
            'device_imei' => Yii::t('app', 'Device Imei'),
            'device_card' => Yii::t('app', 'Device Card'),
            'device_phone' => Yii::t('app', 'Device Phone'),
            'device_name' => Yii::t('app', 'Device Name'),
            'device_master' => Yii::t('app', 'Device Master'),
            'device_status' => Yii::t('app', 'Device Status'),
            'device_debug' => Yii::t('app', 'Device Debug'),
            'device_position' => Yii::t('app', 'Device Position'),
            'device_app' => Yii::t('app', 'Device App'),
            'device_owner' => Yii::t('app', 'Device Owner'),
            'device_type' => Yii::t('app', 'Device Type'),
            'device_create_time' => Yii::t('app', 'Device Create Time'),
            'device_enabled' => Yii::t('app', 'Device Enabled'),
            'device_cardsupply' => Yii::t('app', 'Device Cardsupply'),
            'board_model' => Yii::t('app', 'Board Model'),
            'product_name' => Yii::t('app', 'Product Name'),
        	'owner.owner_name' => Yii::t('app', 'Device Owner'),
        ];
    }
    
    public function getOwner()
    {
    	return $this->hasOne(Owner::className(), ['owner_id'=>'device_owner']);
    }
}
