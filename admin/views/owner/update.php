<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\common\models\Owner */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Owner',
]) . $model->owner_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->owner_id, 'url' => ['view', 'id' => $model->owner_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="owner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
