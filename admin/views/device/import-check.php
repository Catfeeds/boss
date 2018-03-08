<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\common\components\AssignColumn;

$worksheet = $excel->getActiveSheet();

$start = $header ? 2 : 1;

$_GET['filename'] = $filename;

$submitTitle = \Yii::t('app', 'Submit');
$useHeader = Yii::t('app', 'Header exists');

$this->title = Yii::t('app', 'Import Check');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$deviceModel = new \app\common\models\Device();
$deviceAttrs = array_merge(['0'=>'None'], $deviceModel->attributeLabels());

$cols = \PHPExcel_Cell::columnIndexFromString($worksheet->getHighestColumn());


$columnsAssign = [];
for( $col=0; $col<$cols; $col++){
	$columnsAssign[$col] = 0;
	$value = trim((string)$worksheet->getCellByColumnAndRow($col, $start)->getValue());
	if( ctype_digit($value) && strlen($value)==15){
		$columnsAssign[$col] = 'device_imei';
	}
}

$columns = [];
for( $col=0; $col<$cols; $col++){
	$columns[] = [
		'class'=>\app\common\components\AssignColumn::className(),
		'header'=>function($col) use($deviceAttrs, $columnsAssign){
			return Html::dropDownList("columns[$col]", $columnsAssign[$col], $deviceAttrs);
		},
		'assignIndex' => $col,
		'content'=>function($model, $key, $index, $column){
			return $model[$column->assignIndex];
		}
	];
}

$dataProvider = new \app\common\components\ExcelDataProvider([
		'start'=>$start,
		'worksheet'=>$worksheet,
		'pagination' => [
				'pageSize'=>10,
		]
]);
?>

<div class="device-import-check">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['action'=>['import'], 'id'=>'x0']); ?>
    <?= Html::hiddenInput('filename', $filename) ?>
    <div class="checkbox">
    <?= Html::checkbox('header', $header, ['label'=>$useHeader, 'data-bind'=>'checked:header,event:{change:updateHeader}']) ?>
    </div>
<?php Pjax::begin(); ?> <?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'columns' => $columns,
	    ]); ?>
<?php Pjax::end(); ?>
	<?= Html::submitButton($submitTitle, ['class'=>'btn btn-success']) ?>
	<?php ActiveForm::end(); ?>
</div>
<?php $form = ActiveForm::begin(['method'=>'GET','id'=>'updateForm']); ?>
    <?= Html::hiddenInput('filename', $filename) ?>
    <?= Html::checkbox('header', $header, ['style'=>'display:none','data-bind'=>'checked:header']) ?>
<?php ActiveForm::end(); ?>
<?php 
$js=<<<JS
	var viewModel = {
		filename:ko.observable('{$filename}'),
		header:ko.observable({$header}),
		updateHeader:function(f,e){
			setTimeout(function(){
				e.currentTarget = $('#updateForm')[0];
				$.pjax.submit(e, '#p0', {fragment:'#w0', timeout:6000});
			},10);
		}
	};
	ko.applyBindings(viewModel, $(".device-import-index")[0]);
JS;
$this->registerJs($js);
?>
