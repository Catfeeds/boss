<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$profileText = \Yii::t('app', 'Profile');
$settingsText = \Yii::t('app', 'Settings');
$logoutText = \Yii::t('app', 'Logout');

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
    	<?php admin\assets\AdminAsset::register($this); ?>
		<?php $this->head() ?>
	    <style>
	    	#page-wrapper h1{ margin-top: 0}
	    	#page-wrapper { padding-top: 20px }
	    </style>
	</head>
	<body>
		<?php $this->beginBody() ?>
		
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php?r=admin/default">定位管理系统</a>
					<div style="margin-left:250px;padding-top:6px;position:static;width:500px">
						<?= \yii\widgets\Breadcrumbs::widget([
						        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
						]) ?>
                    </div>
				</div>
				<?php if( !\Yii::$app->user->isGuest ){ ?>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fw fa-user"></i><i class="fa fa-caret-down"></i></a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="index.php?r=admin/profile/index"><i class="fa fa-fw fa-user"></i><span><?= $profileText ?></span></a></li>
							<li><a href="index.php?r=admin/default/settings"><i class="fa fa-fw fa-gear"></i><span><?= $settingsText ?></span></a></li>
							<li class='divider'></li>
							<li><a href="index.php?r=admin/default/logout"><i class="fa fa-fw fa-sign-out"></i><span><?= $logoutText ?></span></a></li>
						</ul>
					</li>
				</ul>
				<?php }?>
				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
					<?php
						$submenuTemplate2 = "\n<ul class='nav nav-third-level'>\n{items}\n</ul>\n";
						$submenuTemplate3 = "\n<ul class='nav nav-fourth-level'>\n{items}\n</ul>\n";
						if( !\Yii::$app->user->isGuest ){
							$roles = ArrayHelper::getColumn(\Yii::$app->user->getIdentity()->attach, 'role_attach_role');
							
							if( ! in_array(1, $roles) ){
								$menuRecords = app\common\models\Menu::find()->joinWith(['action', 'action.privilege'])->andWhere(['in', 'privilege_role', $roles])->orderBy('menu_order')->asArray()->all();
							}
							else{
								$menuRecords = app\common\models\Menu::find()->orderBy('menu_order')->asArray()->all();
							}
							function buildMenu($records, $parent)
							{
								$menu = [];
								if(count($records)>0){
									foreach($records as $key=>$val){
										if( $val['menu_parent'] == $parent ){
											$item = ['label'=>$val['menu_title'], 'icon'=>$val['menu_icon']];
											if( $val['menu_href'] ){
												$item['url'] = 'index.php?r='.$val['menu_href'];
											}
											$submenu = buildMenu($records, $val['menu_id']);
											if( $submenu ){
												$item['items'] = $submenu;
											}
											$menu[] = $item;
											unset($records[$key]);
										}
									}
								}
								return $menu;
							}
							$items = buildMenu($menuRecords, 0);
							echo nullref\sbadmin\widgets\MetisMenu::widget(['items'=>$items]);
						}
						?>
					</div>
				</div>
			</nav>
	        <div id="page-wrapper">
				<?= $content ?>
			</div>
		</div>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>