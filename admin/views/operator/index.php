<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Operators');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operator-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Operator'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'operator_name',
            [
            	'label' => \Yii::t('app', 'Operator Role'),
            	'value' => function($model){
            		$roles = ArrayHelper::getColumn($model->attach, 'role.role_name');
            		$owners = ArrayHelper::getColumn($model->attach, 'role.owner.owner_name');
            		$combines = [];
            		for( $i = 0; $i < count($roles); $i++){
            			if( $owners[$i] ){
            				$combines[] = $roles[$i].'['.$owners[$i].']';
            			}
            			else{
            				$combines[] = $roles[$i];
            			}
            		}
            		return join(',', $combines);
				},
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
