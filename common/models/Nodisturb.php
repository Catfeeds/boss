<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%devicend}}".
 *
 * @property integer $devicend_id
 * @property integer $devicend_device
 * @property integer $devicend_begin
 * @property integer $devicend_end
 * @property string $devicend_repeat
 */
class Nodisturb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%devicend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['devicend_device', 'devicend_begin', 'devicend_end', 'devicend_repeat'], 'required'],
            [['devicend_device', 'devicend_begin', 'devicend_end'], 'integer'],
            [['devicend_repeat'], 'string', 'max' => 7],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'devicend_id' => Yii::t('app', 'Devicend ID'),
            'devicend_device' => Yii::t('app', 'Devicend Device'),
            'devicend_begin' => Yii::t('app', 'Devicend Begin'),
            'devicend_end' => Yii::t('app', 'Devicend End'),
            'devicend_repeat' => Yii::t('app', 'Devicend Repeat'),
        ];
    }
}
