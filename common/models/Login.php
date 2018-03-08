<?php

namespace app\common\models;

use yii\base\Model;

class Login extends Model
{
	public $username;
	public $password;
	
	public function rules()
	{
		return [
				// username和password必须
				[['username', 'password'], 'required']
		];
	}
}

?>