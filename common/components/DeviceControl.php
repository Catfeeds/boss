<?php 
namespace app\common\components;

class DeviceControl
{
	protected function perform($device, $uri, $method='GET', $data=null)
	{
		$devObj = \app\common\models\Device::findOne($device);
		
		$url = 'http://localhost:4001/device/'.$devObj->device_imei.$uri;
		
		$curl = curl_init(); // 启动一个CURL会话
		curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
		if( $method=='POST' ){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data ? $data:'1');
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl); // 执行操作
		curl_close($curl); // 关闭CURL会话
		return $result;
	}
	
	public function post($device, $uri, $data='')
	{
		return $this->perform($device, $uri, 'POST', $data);
	}
	
	public function get($device, $uri)
	{
		return $this->perform($device, $uri);
	}
}
?>