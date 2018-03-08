<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\common\models\Device */

$this->registerJsFile('http://webapi.amap.com/maps?v=1.3&key=02cf3980b21d5dbdd8fdc991cfbaa21b');
$this->registerCssFile('@web/admin/css/map.css');
$this->registerJsFile('@web/admin/js/util.js');

$this->title = Yii::t('app', 'Device: '). $model->device_imei;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->device_id, 'url' => ['control', 'id' => $model->device_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Control');

$pos = \app\common\models\LocationRt::find()->where(['location_device'=>$model->device_id])->one();
$lat = 22.6;
$lng = 114;
$address = '';
$locationTime = '';

if( $pos ){
	$lat = $pos->location_lati;
	$lng = $pos->location_longi;
	$address = $pos->location_address;
	$locationTime = $pos->location_time;
}
?>
<div class="device-control">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
    <p>
        <a class="btn btn-primary" data-bind="click:echo">点名</a>
        <a class="btn btn-primary" data-bind="click:location">定位</a>
        <a class="btn btn-primary" data-bind="click:monitor">监听</a>
        <a class="btn btn-primary" data-bind="click:takephoto">拍照</a>
        <a class="btn btn-primary" data-bind="click:find">找手表</a>
        <a class="btn btn-primary" data-bind="click:shutdown">远程关机</a>
        <a class="btn btn-primary" data-bind="click:reset">重启</a>
        <a class="btn btn-primary" data-bind="click:factory">恢复出厂设置</a>
        <a class="btn btn-primary" data-bind="click:syncPhonebook">同步电话本</a>
        <a class="btn btn-primary" data-bind="click:syncNodisturb">同步禁用时间</a>
        <a class="btn btn-primary" data-bind="click:syncAlarm">同步闹钟</a>
    </p>
    </div>
    <div class="row">
		<div id="mapbox" class="panel panel-default col-md-9" style="height:400px;position:relative" >
			<div id="mapcontainer" style="width:100%;height:100%;background:#060"></div>
			<div style="bottom:20px;right:20px;height:3rem;position:absolute" >
				<div class="mapbutton" data-bind="click:updatePosition"><i class="fa fa-map-marker fa-lg"></i></div>
			</div>
		</div>
	
		<div class="panel panel-default col-lg-3">
		    <div class="panel-heading">
		        <h3 class="panel-title">设备信息</h3>
		    </div>
		    <div class="panel-body">
		    	<p><span>状态：</span><span data-bind="html:online">在线</span></p>
		    	<p><span>电量：</span><span data-bind="html:power">在线</span></p>
		    	<p><span>位置：</span><span data-bind="html:address">广东省深圳市南山区朗山路13号清华紫光信息港</span></p>
		    	<p><span>定位时间：</span><span data-bind="html:locationTime">2017-06-17 11:23:00</span></p>
		    	<p><span>服务器：</span><span data-bind="html:serverId">000001</span></p>
		    	<p><span>登录时间：</span><span data-bind="html:loginTime">2017-06-17 11:23:00</span>
		    </div>
		</div>
	</div>
	
	<div class="row">
		<div class="panel panel-default col-lg-3">
		    <div class="panel-heading">
		        <h3 class="panel-title">绑定用户
		    	<a class="pull-right" style="cursor:pointer" data-bind="click:updateBindUsers"><span class="fa fa-refresh"></span></a>
		        </h3>
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<th>用户名</th>
						<th>昵称</th>
						<th>绑定关系</th>
					</thead>
					<tbody data-bind="foreach:bindUsers">
						<td data-bind="html:user_name"></td>
						<td data-bind="html:user_nick"></td>
						<td data-bind="html:bind_nick"></td>
					</tbody>
				</table>
		    </div>
		</div>
		<div class="panel panel-default col-lg-3">
		    <div class="panel-heading">
		        <h3 class="panel-title">电话本
		    	<a class="pull-right" style="cursor:pointer" data-bind="click:updatePhonebook"><i class="fa fa-refresh"></i></span></a>
		        </h3>
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<th>电话</th>
						<th>名字</th>
					</thead>
					<tbody data-bind="foreach:phonebook">
						<td data-bind="html:devicepb_phone"></td>
						<td data-bind="html:devicepb_name"></td>
					</tbody>
				</table>
		    </div>
		</div>
		<div class="panel panel-default col-lg-3">
		    <div class="panel-heading">
		        <h3 class="panel-title">禁用时间
		    	<a class="pull-right" style="cursor:pointer" data-bind="click:updateNodisturbs"><span class="fa fa-refresh"></span></a>
		        </h3>
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<th>开始</th>
						<th>结束</th>
						<th>模式</th>
					</thead>
					<tbody data-bind="foreach:nodisturbs">
						<td data-bind="html:devicend_begin"></td>
						<td data-bind="html:devicend_end"></td>
						<td data-bind="html:devicend_repeat"></td>
					</tbody>
				</table>
		    </div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default col-lg-6">
		    <div class="panel-heading">
		        <h3 class="panel-title">闹钟
		    	<a class="pull-right" style="cursor:pointer" data-bind="click:updateAlarms"><span class="fa fa-refresh"></span></a>
		        </h3>
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<th>时间</th>
						<th>模式</th>
						<th>文字</th>
					</thead>
					<tbody data-bind="foreach:alarms">
						<td data-bind="html:clock_begin"></td>
						<td data-bind="html:clock_repeat"></td>
						<td data-bind="html:about"></td>
					</tbody>
				</table>
		    </div>
		</div>
		
		<div class="panel panel-default col-lg-6">
		    <div class="panel-heading">
		        <h3 class="panel-title">围栏
		    	<a class="pull-right" style="cursor:pointer" data-bind="click:updateFences"><span class="fa fa-refresh"></span></a>
		        </h3>
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<th>地址</th>
						<th>范围</th>
						<th></th>
					</thead>
					<tbody data-bind="foreach:fences">
						<td data-bind="html:address"></td>
						<td data-bind="html:fine_lng2"></td>
						<td><i class="fa fa-eye-slash"></i></td>
					</tbody>
				</table>
		    </div>
		</div>
	</div>
	
	<div class="row">
		<div class="panel panel-default col-lg-6">
		    <div class="panel-heading">
		        <h3 class="panel-title">语音
		    	<a class="pull-right" style="cursor:pointer" data-bind="click:updateVoices"><span class="fa fa-refresh"></span></a>
		        </h3>
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<th>时间</th>
						<th>方向</th>
						<th>URL</th>
					</thead>
					<tbody data-bind="foreach:voices">
						<td data-bind="html:voice_time"></td>
						<td data-bind="html:voice_dir"></td>
						<td><a data-bind="attr:{href:voice_url},html:voice_url"></a></td>
					</tbody>
				</table>
		    </div>
		</div>
		
		<div class="panel panel-default col-lg-6">
		    <div class="panel-heading">
		        <h3 class="panel-title">照片
		    	<a class="pull-right" style="cursor:pointer" data-bind="click:updatePhotos"><span class="fa fa-refresh"></span></a>
		        </h3>
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<th>时间</th>
						<th>URL</th>
					</thead>
					<tbody data-bind="foreach:photos">
						<td data-bind="html:photo_create"></td>
						<td><a data-bind="attr:{href:photo_url},html:photo_url"></a></td>
					</tbody>
				</table>
		    </div>
		</div>
	</div>
	<div class="wait" data-bind="visible:loading" ></div>
</div>

<?php 

$js = <<<JS
	$(document).ready(function(){
		var viewModel = {
			map:null,
			marker:null,
			position:[{$lng}, {$lat}],
			address:ko.observable('{$address}'),
			locationTime:ko.observable('{$locationTime}'),
			serverId:ko.observable('000001'),
			online:ko.observable('离线'),
			power:ko.observable(100),
			loginTime:ko.observable(''),
			loading:ko.observable(0),
			bindUsers:ko.observableArray([]),
			phonebook:ko.observableArray([]),
			nodisturbs:ko.observableArray([]),
			alarms:ko.observableArray([]),
			fences:ko.observableArray([]),
			voices:ko.observableArray([]),
			photos:ko.observableArray([]),
			queryPosition:function(){
				$.ajax({
					url:'index.php?r=api/v1/location/index&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						if( !result ){
							return;
						}
						viewModel.position = [result[0].location_longi, result[0].location_lati];
						viewModel.queryAddress();
						viewModel.locationTime(result[0].location_time);
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			queryAddress:function(){
				$.ajax({
					url:'http://restapi.amap.com/v3/geocode/regeo?key=8668f6085cb8575d7c340bd77040ab0b&location='+viewModel.position[0]+','+viewModel.position[1],
					dataType:'jsonp',
					success:function(result){
						console.log(result);
						viewModel.address(result.regeocode.formatted_address);
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			updatePosition:function(){
				viewModel.marker.setPosition(viewModel.position);
				viewModel.map.panTo(viewModel.position);

				$.ajax({
					url:'index.php?r=api/v1/device-control/info&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						if( result.errcode != 0 ){
							return;
						}
						viewModel.online(result.data.active?'在线':'离线');
						viewModel.power(result.data.power);

						if( result.data.active ){
							viewModel.position = [result.data.location.lng, result.data.location.lat];
							var d = new Date();
							d.setTime(result.data.location.time*1000);
							viewModel.locationTime(d.format('yyyy-MM-dd hh:mm:ss'));
							viewModel.marker.setPosition(viewModel.position);
							viewModel.map.panTo(viewModel.position);
						}
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
				$.ajax({
					url:'index.php?r=api/v1/device-control/host&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						if( result.errcode != 0 ){
							return;
						}
						viewModel.serverId(result.data.server);
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			updateBindUsers:function(){
				$.ajax({
					url:'index.php?r=api/v1/bind-user/index&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						console.log(result);
						viewModel.bindUsers(result);
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			updatePhonebook:function(){
				$.ajax({
					url:'index.php?r=api/v1/phonebook/index&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						console.log(result);
						viewModel.phonebook(result);
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			updateNodisturbs:function(){
				$.ajax({
					url:'index.php?r=api/v1/nodisturb/index&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						console.log(result);
						viewModel.nodisturbs(result);
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			updateAlarms:function(){
				$.ajax({
					url:'index.php?r=api/v1/alarm/index&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						console.log(result);
						viewModel.alarms(result);
					}
				});
			},
			updateFences:function(){
				$.ajax({
					url:'index.php?r=api/v1/fence/index&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						console.log(result);
						var pts = [];
						for( var i=0; i<result.length; i++ ){
							pts.push(''+result[i].fine_lng1+','+result[i].fine_lat1);
						}

						var url = 'http://restapi.amap.com/v3/geocode/regeo?batch=true&key=8668f6085cb8575d7c340bd77040ab0b&location='+pts.join('|');
						$.ajax({
							url:url,
							dataType:'jsonp',
							success:function(result1){
								console.log(result1);
								for( var i=0; i<result1.regeocodes.length; i++ ){
									result[i].address = result1.regeocodes[i].formatted_address;
								}
								viewModel.fences(result);
							},
							error:function(xhReq, text, e){
								console.log(e);
							}
						});
					}
				});
			},
			updateVoices:function(){
				$.ajax({
					url:'index.php?r=api/v1/voice/index&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						console.log(result);
						for( var i=0; i<result.length; i++ ){
							if( result[i].voice_from.indexOf('{$model->device_imei}') >= 0){
								result[i].voice_dir = '发送';
							}
							else{
								result[i].voice_dir = '接收';
							}
						}
						viewModel.voices(result);
					}
				});
			},
			updatePhotos:function(){
				$.ajax({
					url:'index.php?r=api/v1/photo/index&device={$model->device_id}',
					dataType:'json',
					success:function(result){
						console.log(result);
						viewModel.photos(result);
					}
				});
			},
			echo:function(){
				viewModel.loading(true);
				$.ajax({
					url:'index.php?r=api/v1/device-control/echo&device={$model->device_id}',
					success:function(result){
						viewModel.loading(false);
						if( result.errcode == 0 ){
							alert('点名成功');
						}
					},
					error:function(xhReq, text, e){
						console.log(e);
						viewModel.loading(false);
					}
				});
			},
			location:function(){
				viewModel.loading(true);
				$.ajax({
					url:'index.php?r=api/v1/device-control/location&device={$model->device_id}',
					success:function(result){
						if( result.errcode == 0 ){
							viewModel.position = [result.data.lng, result.data.lat];
							viewModel.updatePosition();
						}
						viewModel.loading(false);
					},
					error:function(xhReq, text, e){
						console.log(e);
						viewModel.loading(false);
					}
				});
			},
			monitor:function(){
				var phone = prompt('请输入电话号码', '');
				if( !phone ) return;
				$.ajax({
					url:'index.php?r=api/v1/device-control/monitor&device={$model->device_id}&phone='+phone,
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			takephoto:function(){
				var phone = prompt('请输入电话号码', '');
				if( !phone ) return;
				$.ajax({
					url:'index.php?r=api/v1/device-control/take-photo&device={$model->device_id}&phone='+phone,
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			find:function(){
				$.ajax({
					url:'index.php?r=api/v1/device-control/find&device={$model->device_id}',
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			shutdown:function(){
				$.ajax({
					url:'index.php?r=api/v1/device-control/shutdown&device={$model->device_id}',
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			reset:function(){
				$.ajax({
					url:'index.php?r=api/v1/device-control/reset&device={$model->device_id}',
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			factory:function(){
				$.ajax({
					url:'index.php?r=api/v1/device-control/factory&device={$model->device_id}',
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			syncPhonebook:function(){
				$.ajax({
					url:'index.php?r=api/v1/device-control/sync-phonebook&device={$model->device_id}',
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			syncNodisturb:function(){
				$.ajax({
					url:'index.php?r=api/v1/device-control/sync-nodisturb&device={$model->device_id}',
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			},
			syncAlarm:function(){
				$.ajax({
					url:'index.php?r=api/v1/device-control/sync-alarm&device={$model->device_id}',
					success:function(result){
					},
					error:function(xhReq, text, e){
						console.log(e);
					}
				});
			}
		};
		ko.applyBindings(viewModel, $('.device-control')[0]);

		//$('#mapbox').height((window.innerHeight-51)+'px');
		viewModel.map = new AMap.Map("mapcontainer", {
			center:viewModel.position,
			zoom:14
		});
		viewModel.map.plugin(["AMap.ToolBar"], function() {
            viewModel.map.addControl(new AMap.ToolBar());
        });
		viewModel.marker = new AMap.Marker({
            icon: "http://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
            position: viewModel.position
        });
        viewModel.marker.setMap(viewModel.map);
		viewModel.updatePosition();
		viewModel.updateBindUsers();
		viewModel.updateNodisturbs();
		viewModel.updatePhonebook();
		viewModel.updateAlarms();
		viewModel.updateFences();
		viewModel.updateVoices();
		viewModel.updatePhotos();

		//setInterval(viewModel.queryPosition,30*1000);

		viewModel.queryAddress();
	});
JS;

$this->registerJs($js);
?>
