<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

if( $type == 'menu' ){
	$menus = \app\common\models\Menu::find()->orderBy('menu_order')->all();
}
?>

<div class="action-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'action_name')->textInput(['maxlength' => true]) ?>
	<?php if( $type == 'menu') { ?>
	<?= $form->field($model, 'action_match')->dropDownList(ArrayHelper::map($menus, 'menu_id', 'menu_title'))?>
	<?php }else{ ?>
    <?= $form->field($model, 'action_match')->textInput(['maxlength' => true]) ?>
	<?php }?>
    <?= $form->field($model, 'action_type')->dropDownList([
    	'menu'=> Yii::t('app', 'Menu'),
    	'action' => Yii::t('app', 'Action'),
    	'controller' => Yii::t('app', 'Controller'),
    ])?>
	<?= $form->field($model, 'action_parent')->dropDownList(
		array_merge(['0'=>\Yii::t('app', 'None')], ArrayHelper::map(\app\common\models\Action::find()->all(), 'action_id', 'action_name'))
	)?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
