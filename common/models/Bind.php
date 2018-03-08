<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%bind}}".
 *
 * @property integer $bind_id
 * @property integer $bind_device
 * @property integer $bind_user
 * @property string $bind_nick
 * @property integer $bind_valid
 * @property string $bind_time
 */
class Bind extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bind}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bind_device', 'bind_user', 'bind_nick', 'bind_valid'], 'required'],
            [['bind_device', 'bind_user', 'bind_valid'], 'integer'],
            [['bind_time'], 'safe'],
            [['bind_nick'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bind_id' => Yii::t('app', 'Bind ID'),
            'bind_device' => Yii::t('app', 'Bind Device'),
            'bind_user' => Yii::t('app', 'Bind User'),
            'bind_nick' => Yii::t('app', 'Bind Nick'),
            'bind_valid' => Yii::t('app', 'Bind Valid'),
            'bind_time' => Yii::t('app', 'Bind Time'),
        ];
    }
}
