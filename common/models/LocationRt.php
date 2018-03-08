<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%location_rt}}".
 *
 * @property integer $location_id
 * @property integer $location_device
 * @property string $location_uptime
 * @property double $location_lati
 * @property double $location_longi
 * @property string $location_time
 * @property double $location_speed
 * @property double $location_course
 * @property double $location_eleva
 * @property double $location_accuracy
 * @property integer $location_cellid
 * @property string $location_address
 */
class LocationRt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_rt}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_device', 'location_lati', 'location_longi', 'location_speed', 'location_course', 'location_eleva', 'location_accuracy', 'location_cellid'], 'required'],
            [['location_device', 'location_cellid'], 'integer'],
            [['location_uptime', 'location_time'], 'safe'],
            [['location_lati', 'location_longi', 'location_speed', 'location_course', 'location_eleva', 'location_accuracy'], 'number'],
            [['location_address'], 'string', 'max' => 255],
            [['location_device'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => Yii::t('app', 'Location ID'),
            'location_device' => Yii::t('app', 'Location Device'),
            'location_uptime' => Yii::t('app', 'Location Uptime'),
            'location_lati' => Yii::t('app', 'Location Lati'),
            'location_longi' => Yii::t('app', 'Location Longi'),
            'location_time' => Yii::t('app', 'Location Time'),
            'location_speed' => Yii::t('app', 'Location Speed'),
            'location_course' => Yii::t('app', 'Location Course'),
            'location_eleva' => Yii::t('app', 'Location Eleva'),
            'location_accuracy' => Yii::t('app', 'Location Accuracy'),
            'location_cellid' => Yii::t('app', 'Location Cellid'),
            'location_address' => Yii::t('app', 'Location Address'),
        ];
    }
}
