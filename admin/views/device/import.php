<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$submitTitle = \Yii::t('app', 'Submit');

$this->title = Yii::t('app', 'Import');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="device-import">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin(['action' =>['import-check'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
	
	<?= $form->field($model, 'file')->fileInput() ?>
	
	<?= Html::submitButton($submitTitle, ['class'=>'btn btn-success']) ?>
	
	<?php ActiveForm::end() ?>
</div>