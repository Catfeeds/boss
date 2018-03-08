<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\common\models\RoleAttach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-attach-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role_attach_operator')->textInput() ?>

    <?= $form->field($model, 'role_attach_role')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
