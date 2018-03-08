<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\common\models\RoleAttach */

$this->title = Yii::t('app', 'Create Role Attach');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Role Attaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-attach-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
