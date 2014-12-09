<?php

/**
 * 控制器基类
 * @author CGY
 *
 */

namespace System\Controller;

abstract class BaseController extends \Think\Controller {
	
	
	public $currUser = ''; 		// 当前管理员
	public $isLogined = false;  // 是否登录
	public $statusNames = array('禁用','启用');
	public $isShow = array('不显示','显示');
	
	/**
	 * 初始化
	 */
	protected function _initialize() {		
		$this->assign('pageSize', C('PAGE_SIZE'));		
		$this->getCurrUser();
		$this->saveLog();
	}
	
	
	/**
	 * 获取筛选条件参数
	 */
	protected  function getSelectParam($idFieldNum='',$idFieldStr=''){
		$param = I('post.');
		if(!empty($idFieldNum) && !empty($idFieldStr)){
			$tmp = $param['where'][$idFieldNum];
			if(!is_numeric($tmp) && !is_array($tmp) && !empty($tmp)) {
				$param['where'][$idFieldStr] = $tmp;
				unset($param['where'][$idFieldNum]);  
			}
		}
		return $param;
	}
	
	/**
	 * 判断是否登录及获取当前管理员信息
	 */
	protected function getCurrUser() {
	
		$currUser = Session("system_curr_user");

		if(empty($currUser)) return;
		$currUser = unserialize(authcode($currUser));
		if(! isset($currUser ['id'])) return;
		$user = D("SysUser")->selectOne($currUser ['id']);
		if(! $user) return;
		if(! $user ['status'])	return; // 帐号禁用
		$this->isLogined = true;
		unset($user ['password']);
		$user ['auth'] = unserialize($user ['auth']);
		$user ['upTime'] = $currUser ['lastTime'];
		$user ['upIp'] = $currUser ['lastIp'];
		$this->currUser = $user;
	}
	
	/**
	 * 输出结果 
	 * @param $result array  	 结果集(格式：result_data)
	 * @param $url string      	 跳转地址
	 */
	protected function showResult($result, $url = '') {
		$result ['url'] = $url;
		$this->ajaxReturn($result);
	}
	
	/**
	 * 获取下拉框HTML
	 *
	 * @param $list array	数据列表
	 * @param $listName string	下拉框名称
	 * @param $options array 扩展参数 array('selVal','valKey','textKey','levelKey','nullText','width','editable')
	 */
	protected function getComboBox($list, $listName,$options=array()) {
		$defoptions = array(
			'selVal'	=> '',
			'valKey' 	=> '',
			'textKey' 	=> '',
			'levelKey'	=> '',
			'nullText'	=> '请选择',
			'nullVal'	=> '',
			'width'		=> '132',
			'editable'	=> false,
			
		);
		$options = array_merge($defoptions,$options);
		$html = '<select class="easyui-combobox" id="' . str_replace(']','',str_replace('[', '_', $listName)) . '" name="' . $listName . '" style="width:' . $options['width'] . 'px;" editable="'.$options['editable'].'">';
		if(!empty($options['nullText'])) $html .= '<option value="'.$options['nullVal'].'">'.$options['nullText'].'</option>';
		foreach($list as $k => $v) {
			$val = empty($options['valKey']) ? $k : $v [$options['valKey']];			
			$text = (($options['levelKey'] && $v[$options['levelKey']]) ? str_repeat("　",$v[$options['levelKey']]*2) : '') . (empty($options['textKey']) ? $v : $v [$options['textKey']]);			
			$html .= '<option value="' . $val . '" ' .($options['selVal'] == $val ? 'selected' : '') . '>' . $text . '</option>';			
		}
		$html .= '</select>';
		return $html;
	}
	
	
	/**
	 * 导出数据
	 * 
	 * @param $title string       	
	 * @param $column array       	
	 * @param $list array       	
	 */
	protected function exportExcel($title, $column, $list) {
		if(! isset($list ['rows']) || count($list ['rows']) < 1) {
			$this->error('未找到相关数据，无需导出！', '#');
			exit();
		}
		$tmp = '';
		foreach($list ['rows'] [0] as $key => $row) {
			$txt .= $tmp . $column [$key] [0];
			$tmp = ',';
		}
		foreach($list ['rows'] as $row) {
			$txt .= "\r\n";
			$tmp = '';
			foreach($row as $col) {
				$txt .= $tmp . $col;
				$tmp = ',';
			}
		}
		header("Content-type:application/vnd.ms-excel; charset=gb2312");
		header("content-Disposition:filename=" . time() . ".csv");
		exit(iconv("utf-8", "gb2312//IGNORE", $txt));	
	}
	
	/**
	 * 保存操作日志
	 */
	private function saveLog(){
		
		if(!IS_POST) return;
		if(in_array(ACTION_NAME,C('LOG_IGNOIE_ACTIONS'))) return;
		$data = array(
				'userName'	=> $this->currUser['name'],
				'controller'=> CONTROLLER_NAME,
				'action'	=> ACTION_NAME,
				'addTime'	=> NOW_TIME,
				'data'		=> array('get'=>$_GET,'post'=>$_POST),
		);
		unset($data['data']['get']['_URL_']);
		unset($data['data']['post']['password']);
		$data['data'] = serialize($data['data']);
		M('SysLog')->add($data);
	}

}