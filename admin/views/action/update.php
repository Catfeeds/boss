<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\common\models\Action */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Action',
]) . $model->action_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->action_id, 'url' => ['view', 'id' => $model->action_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$type = $model->action_type;
?>
<div class="action-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'type' => $type
    ]) ?>

</div>
