<?php 
namespace admin\assets;

class PageAsset extends \yii\web\AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	
	//全局CSS
	public $css = [
	];
	//全局JS
	public $js = [
			'http://cdn.bootcss.com/knockout/3.4.0/knockout-debug.js'
	];
	//依赖关系
	public $depends = [
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset',
	];
	
	//定义按需加载JS方法，注意加载顺序在最后
	public static function addScript($view, $jsfile, $depends=[]) {
		$view->registerJsFile($jsfile, [PageAsset::className(), 'depends' => 'admin\assets\PageAsset']);
	}
	
	//定义按需加载css方法，注意加载顺序在最后
	public static function addCss($view, $cssfile, $depends=[]) {
		$view->registerCssFile($cssfile, [PageAsset::className(), 'depends' => 'admin\assets\PageAsset']);
	}  
}

?>
