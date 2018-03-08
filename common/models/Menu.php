<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $menu_id
 * @property string $menu_title
 * @property string $menu_href
 * @property integer $menu_parent
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_title'], 'required'],
            [['menu_parent', 'menu_order'], 'integer'],
            [['menu_title', 'menu_icon'], 'string', 'max' => 32],
            [['menu_href'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => Yii::t('app', 'Menu ID'),
            'menu_title' => Yii::t('app', 'Menu Title'),
        	'menu_icon' => Yii::t('app', 'Menu Icon'),
            'menu_href' => Yii::t('app', 'Menu Href'),
            'menu_parent' => Yii::t('app', 'Menu Parent'),
        	'menu_order' => Yii::t('app', 'Menu Order'),
        	'parent.menu_title' => Yii::t('app', 'Menu Parent'),
        ];
    }
    
    public function getParent()
    {
    	return $this->hasOne(Menu::className(), ['menu_id'=>'menu_parent']);
    }
    
    public function getAction()
    {
    	return $this->hasOne(Action::className(), ['action_match'=>'menu_id'])->where(['action_type'=>'menu']);
    }
}
