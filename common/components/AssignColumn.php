<?php 
namespace app\common\components;

use \yii\grid\Column;

class AssignColumn extends Column
{
	public $assignIndex;
	
	protected function renderHeaderCellContent()
	{
		if( is_callable($this->header) ){
			return call_user_func($this->header, $this->assignIndex);
		}
		return parent::renderHeaderCellContent();
	}
}
?>