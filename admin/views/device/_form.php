<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$owners = \app\common\models\Owner::find()->all();
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_imei')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'device_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'device_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'device_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'device_master')->textInput() ?>

    <?= $form->field($model, 'device_owner')->dropDownList(array_merge(['0'=>Yii::t('app', 'None')],ArrayHelper::map($owners, 'owner_id', 'owner_name'))) ?>

    <?= $form->field($model, 'device_type')->textInput() ?>

    <?= $form->field($model, 'board_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
