<?php 

namespace app\common\models;

use \yii\base\Model;

class DeviceImport extends Model {
	
	public $filename;
	public $header;
	public $columns;
	
	public function rules()
	{
		return [
				[['filename','header','columns'], 'safe']
		];
	}
}

?>