<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$user = \Yii::$app->user->getIdentity();

$userRoles = ArrayHelper::getColumn($user->attach, 'role_attach_role');

$query = \app\common\models\Role::find();
if( !in_array(1, $userRoles)){
	$actionCreate = \app\common\models\Action::find()->where(['action_match'=>'admin/operator/create'])->one();
	$actionUpdate = \app\common\models\Action::find()->where(['action_match'=>'admin/operator/update'])->one();
	
	$ownersQuery = \app\common\models\Role::find()->where(['in', 'role_id', $userRoles]);
	
	if( $actionCreate ){
		$ownersQuery = $ownersQuery->joinWith(['privilege'])->andWhere(['in', 'privilege_action', [$actionCreate->action_id,$actionUpdate->action_id]]);
	}
	
	$userOwners = ArrayHelper::getColumn($ownersQuery->all(), 'role_owner');
	
	$query = $query->andWhere(['in', 'role_owner', $userOwners]);
}

$roles = $query->all();
$rolesMap = [];
foreach( $roles as $role ){
	$owner_name = '';
	if( $role->owner ){
		$owner_name = '['.$role->owner->owner_name.']';
	}
	$rolesMap[$role->role_id] = $role->role_name.$owner_name;
}
$attach = ArrayHelper::getColumn($model->attach, 'role_attach_role');
?>

<div class="operator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operator_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operator_pswd')->passwordInput(['maxlength' => true]) ?>

    <?= Html::checkBoxList('Operator[attach]', $attach, $rolesMap) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
