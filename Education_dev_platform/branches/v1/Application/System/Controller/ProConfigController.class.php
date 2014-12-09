<?php
/**
 * 控制器：产品相关配置
 * @author CGY
 *
 */

namespace System\Controller;
class ProConfigController extends BaseAuthController {
	
	/**
	 * 查看操作
	 */
	public function indexAct(){
		
		if(! IS_POST) {
			$this->assign(array(
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del','config','cnftpl','sync')),
			));
			$this->display();
		} else {
			$data = D('ProConfig')->selectPage();
			$this->ajaxReturn($data);
		}
	}
	
	/**
	 * 添加操作
	 */
	public function addAct() {
		$this->set();
	}
	/**
	 * 编辑操作
	 */
	public function editAct() {
		$this->set();
	}
	
	/**
	 * 删除操作
	 */
	public function delAct() {
		$this->showResult( D('ProConfig')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {
		if(! IS_POST) {
			$id = I('id','');
			if(!empty($id)){
				$config = D('ProConfig')->find($id);
			}
			$this->assign(array('config' => $config));
			$this->display('edit');
		} else {
			$data = I('post.');
			$data['cKey'] = str_replace('_', "*",$data['cKey']); //屏蔽下划线(会引起缓存问题,缓存中已使用下划线)
			$this->showResult(D('ProConfig')->saveData($data));
		}
	}
	
	/**
	 * 配置信息
	 */
	public function configAct(){
		if(!IS_POST){
			$id = I('id','');
			$record = D('ProConfig')->find($id); //读取配置记录项
			$config = D('ProConfig','Logic')->getConfig($record['cKey']); //读取配置数据

			//格式化数据：把配置的数据格式化成配置模版中的格式
			if($config['status']){
				$proConf = $config['data'];
				foreach($proConf as $key=>$item){
					if($item['type']=='array'){ //数组类型
						$tmp = '';
						foreach($item['value'] as $k=>$v){
							$tmp[] = $k .'='.$v;
						}
						$proConf[$key]['value'] = trim(implode("\r\n",$tmp));
					}elseif($item['type']=='textarea'){ //文本域类型
						$proConf[$key]['value'] = trim(str_replace('<br/>', "\r\n",$proConf[$key]['value']));
					}
				}
			}else{
				$this->showResult($config);
			}
			
			$this->assign(array('proConf' => $proConf, 'id' => $record['id'], 'name' => $record['name']));
			$this->display();
		}else{
			$this->showResult(D('ProConfig','Logic')->updateConfig(I('post.')));
		}
	}
	
	/**
	 * 重新加载配置文件（把模版文件中的配置项更新到数据库和缓存中）
	 */
	public function reloadConfAct(){
		$id = I('id','');
		$record = D('ProConfig')->find($id); //读取配置记录项
		$config = D('ProConfig','Logic')->getConfigTpl($record['cKey']); //读取配置文件,并放到内存中
		
		//格式化数据：把配置的数据格式化成配置模版中的格式
		if($config['status']){
			$data['id'] = $id;
			foreach ($config['data'] as $k => $v){
				switch ($v['type']){
					case 'array': 	 //数组类型
						$tmp = '';
						foreach($v['value'] as $k1 => $v1){
							$tmp[] = $k1 .'='.$v1;
						}
						$data[$k] = trim(implode("\r\n",$tmp));
						break;
					case 'textarea': //文本域类型
						$data[$k] = trim(str_replace('<br/>', "\r\n",$v['value']));
						break;
				}
			}
			$this->showResult(D('ProConfig','Logic')->updateConfig($data));
		}else{
			$this->showResult($config);
		}
	}
	
	/**
	 * 同步数据
	 */
	public function syncAct(){	
		$this->showResult(D('Sync','Logic')->send());
	}

}