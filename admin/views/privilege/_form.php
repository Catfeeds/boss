<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$roles = \app\common\models\Role::find()->all();
$actions = \app\common\models\Action::find()->all();

$rolesMap = [];
foreach( $roles as $role ){
	$rolesMap[$role[role_id]] = $role['role_name'].'['.$role->owner->owner_name.']';
}
?>

<div class="privilege-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'privilege_action')->dropDownList(ArrayHelper::map($actions, 'action_id','action_name')) ?>

    <?= $form->field($model, 'privilege_role')->dropDownList($rolesMap)?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
