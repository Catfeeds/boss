<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%devicepb}}".
 *
 * @property integer $devicepb_id
 * @property integer $devicepb_device
 * @property string $devicepb_phone
 * @property string $devicepb_name
 */
class Phonebook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%devicepb}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['devicepb_device', 'devicepb_phone', 'devicepb_name'], 'required'],
            [['devicepb_device'], 'integer'],
            [['devicepb_phone'], 'string', 'max' => 16],
            [['devicepb_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'devicepb_id' => Yii::t('app', 'Devicepb ID'),
            'devicepb_device' => Yii::t('app', 'Devicepb Device'),
            'devicepb_phone' => Yii::t('app', 'Devicepb Phone'),
            'devicepb_name' => Yii::t('app', 'Devicepb Name'),
        ];
    }
}
