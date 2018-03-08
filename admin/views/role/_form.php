<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


$user = \Yii::$app->user->getIdentity();

$userRoles = ArrayHelper::getColumn($user->attach, 'role_attach_role');

if( !in_array(1, $userRoles) ){
	$actionCreate = \app\common\models\Action::find()->where(['action_match'=>'admin/role/create'])->one();
	$actionUpdate = \app\common\models\Action::find()->where(['action_match'=>'admin/role/update'])->one();
	
	$ownersQuery = \app\common\models\Role::find()->where(['in', 'role_id', $userRoles]);
	
	if( $actionCreate ){
		$ownersQuery = $ownersQuery->joinWith(['privilege'])->andWhere(['in', 'privilege_action', [$actionCreate->action_id,$actionUpdate->action_id]]);
	}
		
	$userOwners = ArrayHelper::getColumn($ownersQuery->all(), 'owner');
		
	$owners = ArrayHelper::map($userOwners, 'owner_id', 'owner_name');
}
else{
	$owners = array_merge(['0'=>Yii::t('app', 'None')], ArrayHelper::map(\app\common\models\Owner::find()->all(), 'owner_id', 'owner_name'));
}
?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_owner')->dropDownList($owners) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
