<?php 

namespace app\common\models;

use \yii\base\Model;

class DeviceImportCheck extends Model {
	
	public $file;
	
	public function rules()
	{
		return [
				[['file'], 'required'],
				[['file'], 'file'],
		];
	}
}

?>