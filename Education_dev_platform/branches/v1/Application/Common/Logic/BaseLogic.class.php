<?php
/**
 * 逻辑处理类：基类
 */
namespace Common\Logic;
class BaseLogic {
    
	// 返回数据是否为空
	protected function returnListData($list = '') {
		if (! isset($list ['rows']) || ! is_array($list ['rows']) || empty($list['rows'])) {
			return array ('rows' => array (), 'total' => 0);
		} else {
			return $list;
		}
	}
	
	protected function getPage($page,$pageSize){
		$page = $page<=0 ? 1 : $page;
		$pageSize = empty($pageSize) ? C('PAGE_SIZE') : $pageSize;
		return array($page,$pageSize);
	}
	
	/**
	 * 获取配置文件模版
	 * @param unknown_type $cnfKey
	 */
	public function getConfigTpl($cnfKey){
		//判断参数是完整的文件名还是关键字
		if(strpos($cnfKey, '.php') === false){
			$r = D('ProConfig')->selectOne(array('cKey' => $cnfKey));
			$filename = $r['templete'];
		}else{ 
			$filename = $cnfKey;
		}	
		if(!is_file(CONF_PATH.$filename)) return result_data(0,'配置模版'. $filename .'不存在！','');
		$configTpl = include(CONF_PATH.$filename);
		return result_data(1,'读取模版文件成功！',$configTpl);
	}
	
}