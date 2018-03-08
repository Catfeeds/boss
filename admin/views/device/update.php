<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\common\models\Device */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Device',
]) . $model->device_imei;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->device_id, 'url' => ['view', 'id' => $model->device_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="device-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
