<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Devices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <form id="op">
    <p>
        <?= Html::a(Yii::t('app', 'Create Device'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Import'), ['import'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Outport'), ['outport'], ['class' => 'btn btn-success', 'data-bind'=>"click:outport"]) ?>
        <a class="fa fa-search" style="padding:0 5px;border:1px solid #888;border-radius:5px;height:32px;line-height:28px;">
        <?= Html::textInput('search', '', ['style'=>'border:0', 'data-bind'=>"value:search,event:{keyup:searchUpdate}"]) ?>
        </a>
    </p>
    </form>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'device_imei',
            'device_phone',
            'device_name',
            'owner.owner_name',
            'device_type',
            'board_model',
            'product_name',

            [
            	'class' => 'yii\grid\ActionColumn',
            	'template' => '{view} {update} {delete} {control}',
            	'buttons' => [
            		// 自定义按钮
            		'control' => function ($url, $model, $key) {
            			$options = [
            				'title' => Yii::t('yii', 'Control'),
            				'aria-label' => Yii::t('yii', 'Control'),
            				'data-pjax' => '0',
            			];
            			return Html::a('<span class="glyphicon glyphicon-wrench"></span>', $url, $options);
					},
				]
			],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php 
$js=<<<JS
	var viewModel = {
		search:ko.observable('{$search}'),
		searchUpdate:function(f, e){
			e.currentTarget = $('#op')[0];
			$.pjax.submit(e, '#p0', {fragment:'#w0', timeout:6000});
		},
		outport:function(f, e){
			alert('outport');
		},
	};
	ko.applyBindings(viewModel, $(".device-index")[0]);
JS;
$this->registerJs($js);
?>
