<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%fine}}".
 *
 * @property integer $fine_id
 * @property integer $fine_device
 * @property integer $fine_user
 * @property string $fine_name
 * @property integer $fine_type
 * @property double $fine_lng1
 * @property double $fine_lat1
 * @property double $fine_lng2
 * @property double $fine_lat2
 * @property integer $fine_enabled
 * @property string $fine_update
 * @property string $fine_address
 *
 * @property FineMap[] $fineMaps
 */
class Fence extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fine}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fine_device', 'fine_user', 'fine_name', 'fine_type', 'fine_lng1', 'fine_lat1', 'fine_lng2', 'fine_lat2'], 'required'],
            [['fine_device', 'fine_user', 'fine_type', 'fine_enabled'], 'integer'],
            [['fine_lng1', 'fine_lat1', 'fine_lng2', 'fine_lat2'], 'number'],
            [['fine_update'], 'safe'],
            [['fine_address'], 'string'],
            [['fine_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fine_id' => Yii::t('app', 'Fine ID'),
            'fine_device' => Yii::t('app', 'Fine Device'),
            'fine_user' => Yii::t('app', 'Fine User'),
            'fine_name' => Yii::t('app', 'Fine Name'),
            'fine_type' => Yii::t('app', 'Fine Type'),
            'fine_lng1' => Yii::t('app', 'Fine Lng1'),
            'fine_lat1' => Yii::t('app', 'Fine Lat1'),
            'fine_lng2' => Yii::t('app', 'Fine Lng2'),
            'fine_lat2' => Yii::t('app', 'Fine Lat2'),
            'fine_enabled' => Yii::t('app', 'Fine Enabled'),
            'fine_update' => Yii::t('app', 'Fine Update'),
            'fine_address' => Yii::t('app', 'Fine Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaps()
    {
        return $this->hasMany(FenceMap::className(), ['fine_map_fine' => 'fine_id']);
    }
}
