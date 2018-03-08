<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\common\models\Operator */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Operator',
]) . $model->operator_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->operator_id, 'url' => ['view', 'id' => $model->operator_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="operator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
