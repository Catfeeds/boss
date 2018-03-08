<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\common\models\Privilege */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Privilege',
]) . $model->privilege_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Privileges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->privilege_id, 'url' => ['view', 'id' => $model->privilege_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="privilege-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
