<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%owner}}".
 *
 * @property integer $owner_id
 * @property string $owner_name
 * @property integer $owner_parent
 */
class Owner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%owner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_parent'], 'integer'],
            [['owner_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'owner_id' => Yii::t('app', 'Owner ID'),
            'owner_name' => Yii::t('app', 'Owner Name'),
            'owner_parent' => Yii::t('app', 'Owner Parent'),
        	'parent.owner_name' => Yii::t('app', 'Owner Parent'),
        ];
    }
    
    public function getParent()
    {
    	return $this->hasOne(Owner::className(), ['owner_id'=>'owner_parent']);
    }
}
