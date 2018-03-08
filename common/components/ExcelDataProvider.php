<?php 
namespace app\common\components;

class ExcelDataProvider extends \yii\data\BaseDataProvider
{
	public $worksheet;
	public $start = 1;
	
	protected function prepareModels()
	{
		$rows = $this->worksheet->getHighestRow();
		$cols = \PHPExcel_Cell::columnIndexFromString($this->worksheet->getHighestColumn());
		
		$offset = 0;
		$limit = $rows;
		
		if (($pagination = $this->getPagination()) !== false) {
			$pagination->totalCount = $this->getTotalCount();
			
			if ($pagination->getPageSize() > 0) {
				$offset = $pagination->getOffset();
				$limit = $pagination->getLimit();
			}
		}
		
		$data = [];
		for( $row=$this->start+$offset; $row<=$offset+$limit && $row<=$rows; $row++ ){
			for( $col=0; $col<$cols; $col ++){
				$data[$row][] = trim((string)$this->worksheet->getCellByColumnAndRow($col, $row)->getValue());
			}
		}
		return $data;
	}
	
	protected function prepareKeys($models)
	{
		$rows = $this->worksheet->getHighestRow();
		$keys = [];
		for( $i = 1; $i <= $rows; $i++){
			$keys[] = $i;
		}
		return $keys;
	}
	
	protected function prepareTotalCount()
	{
		return $this->worksheet->getHighestRow();
	}
}

?>