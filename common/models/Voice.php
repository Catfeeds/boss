<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%voice}}".
 *
 * @property integer $voice_id
 * @property string $voice_to
 * @property string $voice_from
 * @property string $voice_url
 * @property integer $voice_post
 * @property integer $voice_read
 * @property integer $voice_duration
 * @property string $voice_time
 */
class Voice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%voice}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['voice_to', 'voice_from', 'voice_url', 'voice_duration'], 'required'],
            [['voice_post', 'voice_read', 'voice_duration'], 'integer'],
            [['voice_time'], 'safe'],
            [['voice_to', 'voice_from'], 'string', 'max' => 32],
            [['voice_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'voice_id' => Yii::t('app', 'Voice ID'),
            'voice_to' => Yii::t('app', 'Voice To'),
            'voice_from' => Yii::t('app', 'Voice From'),
            'voice_url' => Yii::t('app', 'Voice Url'),
            'voice_post' => Yii::t('app', 'Voice Post'),
            'voice_read' => Yii::t('app', 'Voice Read'),
            'voice_duration' => Yii::t('app', 'Voice Duration'),
            'voice_time' => Yii::t('app', 'Voice Time'),
        ];
    }
}
