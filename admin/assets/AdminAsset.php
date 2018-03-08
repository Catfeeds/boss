<?php 
namespace admin\assets;

class AdminAsset extends \yii\web\AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	
	//全局CSS
	public $css = [
	];
	//全局JS
	public $js = [
	];
	//依赖关系
	public $depends = [
			'nullref\sbadmin\assets\SBAdminAsset',
			'admin\assets\PageAsset',
	];
	
	//定义按需加载JS方法，注意加载顺序在最后
	public static function addScript($view, $jsfile, $depends=[]) {
		$view->registerJsFile($jsfile, [AdminAsset::className(), 'depends' => 'admin\assets\AdminAsset']);
	}
	
	//定义按需加载css方法，注意加载顺序在最后
	public static function addCss($view, $cssfile, $depends=[]) {
		$view->registerCssFile($cssfile, [AdminAsset::className(), 'depends' => 'admin\assets\AdminAsset']);
	}  
}

?>
