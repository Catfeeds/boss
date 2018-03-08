<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\common\models\RoleAttach */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Role Attach',
]) . $model->role_attach_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Role Attaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_attach_id, 'url' => ['view', 'id' => $model->role_attach_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="role-attach-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
