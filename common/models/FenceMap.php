<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%fine_map}}".
 *
 * @property integer $fine_map_id
 * @property integer $fine_map_fine
 * @property integer $fine_map_device
 *
 * @property Fine $fineMapFine
 */
class FenceMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fine_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fine_map_fine', 'fine_map_device'], 'required'],
            [['fine_map_fine', 'fine_map_device'], 'integer'],
            [['fine_map_fine'], 'exist', 'skipOnError' => true, 'targetClass' => Fine::className(), 'targetAttribute' => ['fine_map_fine' => 'fine_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fine_map_id' => Yii::t('app', 'Fine Map ID'),
            'fine_map_fine' => Yii::t('app', 'Fine Map Fine'),
            'fine_map_device' => Yii::t('app', 'Fine Map Device'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFence()
    {
        return $this->hasOne(Fence::className(), ['fine_id' => 'fine_map_fine']);
    }
}
