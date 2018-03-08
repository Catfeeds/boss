<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%clock}}".
 *
 * @property integer $id
 * @property integer $devicend_begin
 * @property integer $clock_device
 * @property integer $devicend_end
 * @property string $about
 * @property string $devicend_repeat
 */
class Alarm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%clock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['devicend_begin', 'clock_device', 'devicend_end'], 'integer'],
            [['about', 'devicend_repeat'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'devicend_begin' => Yii::t('app', 'Devicend Begin'),
            'clock_device' => Yii::t('app', 'Clock Device'),
            'devicend_end' => Yii::t('app', 'Devicend End'),
            'about' => Yii::t('app', 'About'),
            'devicend_repeat' => Yii::t('app', 'Devicend Repeat'),
        ];
    }
}
