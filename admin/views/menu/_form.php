<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$parents = \app\common\models\Menu::find()->orderBy('menu_order')->all();

?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'menu_title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'menu_icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_parent')->dropDownList(array_merge(['0'=>Yii::t('app', 'None')], ArrayHelper::map($parents, 'menu_id', 'menu_title'))) ?>

	<?= $form->field($model, 'menu_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
