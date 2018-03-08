<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property integer $photo_id
 * @property integer $photo_device
 * @property string $photo_to
 * @property string $photo_url
 * @property double $photo_lat
 * @property double $photo_lng
 * @property string $photo_create
 * @property integer $photo_enabled
 * @property string $photo_sid
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo_device', 'photo_to', 'photo_url', 'photo_lat', 'photo_lng'], 'required'],
            [['photo_device', 'photo_enabled'], 'integer'],
            [['photo_lat', 'photo_lng'], 'number'],
            [['photo_create'], 'safe'],
            [['photo_to', 'photo_url'], 'string', 'max' => 255],
            [['photo_sid'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'photo_id' => Yii::t('app', 'Photo ID'),
            'photo_device' => Yii::t('app', 'Photo Device'),
            'photo_to' => Yii::t('app', 'Photo To'),
            'photo_url' => Yii::t('app', 'Photo Url'),
            'photo_lat' => Yii::t('app', 'Photo Lat'),
            'photo_lng' => Yii::t('app', 'Photo Lng'),
            'photo_create' => Yii::t('app', 'Photo Create'),
            'photo_enabled' => Yii::t('app', 'Photo Enabled'),
            'photo_sid' => Yii::t('app', 'Photo Sid'),
        ];
    }
}
