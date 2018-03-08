<?php
namespace app\api;

class Module extends \yii\base\Module
{	
	public function init()
	{
		parent::init();
		$this->modules = [
			'v1' => [
					'class'=>'app\api\v1\Module'
			]	
		];
	}
}

?>
