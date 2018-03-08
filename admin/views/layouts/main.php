<?php
use yii\helpers\Html;

$this->beginPage(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title)?></title>
    	<?php admin\assets\PageAsset::register($this); ?>
		<?php $this->head() ?>
	</head>
	<body>
		<?php $this->beginBody() ?>
		<?= $content ?>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>