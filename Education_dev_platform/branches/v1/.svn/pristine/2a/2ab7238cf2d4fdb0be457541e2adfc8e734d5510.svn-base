<?php

/**
 * 应用于需要权限验证的控制器基类
 * @author CGY
 *
 */

namespace System\Controller;

abstract class BaseAuthController extends BaseLoginController {
	
		
	/**
	 * 初始化
	 */
	protected function _initialize() {
		
		parent::_initialize();
		// 判断页面操作权限
		//$this->authList = require(MODULE_PATH . 'Conf/auth.php'); // 载入菜单及页面操作权限结构
		if(! $this->isActionAuth()) {
			$this->error("对不起，您无该项操作权限！", "#");
		}
	}
	
	
	
	/**
	 * 判断某个操作是否有权限
	 * 
	 * @param $key unknown_type     	
	 */
	protected function isActionAuth($action='',$controller='') {
		if(empty($this->currUser))
			return false;
		if($this->currUser ['isSuper'])
			return true;
		if(empty($action)) $action = ACTION_NAME;
		if(empty($controller)) $controller = CONTROLLER_NAME;
		$key = $controller.'_'.$action;
		return (isset($this->currUser ['auth'] ['nav'] [$key]) && $this->currUser ['auth'] ['nav'] [$key]);
	}
	
	/**
	 * 根据权限判断操作按钮的显示与隐藏
	 * @param unknown_type $arr
	 * @return string
	 */
	protected function buttonAuthStyle($arr){
		foreach($arr as $val){
			$style[$val] = $this->isActionAuth($val) ? '' : 'style="display:none;"';
		}
		return $style;
	}
	
}