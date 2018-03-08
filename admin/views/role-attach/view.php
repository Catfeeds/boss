<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\common\models\RoleAttach */

$this->title = $model->role_attach_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Role Attaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-attach-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->role_attach_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->role_attach_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'role_attach_id',
            'role_attach_operator',
            'role_attach_role',
        ],
    ]) ?>

</div>
