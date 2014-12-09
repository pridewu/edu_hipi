<?php
/**
 * 逻辑处理类：数据同步(后台同步到前端)
 * @author CGY
 *
 */
namespace Common\Logic;
class SyncLogic extends BaseLogic {
	
	/**
	 * 数据发送
	 */
	public function send($name=''){
		$items = array(
			'ProConfig',
			'Channel',
			'Stage',
			'AdSpace',
			'Ad',
		);
		
		//name不为空，则发送某一项的数据，否则全部发送
		if(!empty($name)){
			foreach ($items as $k=>$v){
				if($v != $name) unset($items[$k]);
			}
		}
		foreach ($items as $key => $val){
			$data[$val] = S($val);
		}
		
		return $this->sendData(array('action'=>'data','name'=>$name,'data'=>$data));
	}
	
	/**
	 * 通讯测试
	 */
	public function test(){
		return $this->sendData(array('action'=>'test'));
	}
	
	private function sendData($param){
		$url 		= C('WEB_URL');
		$checkCode  = C('CHECK_CODE');
		$param 		= json_encode($param);
		$post = array(
			'param' => $param,
			'sign'	=> md5($param.$checkCode),
		);
		$data = url_data($url,$post);
		if(is_json($data)){
			$data = json_decode($data, true);
		}
		return $data;
	}
}