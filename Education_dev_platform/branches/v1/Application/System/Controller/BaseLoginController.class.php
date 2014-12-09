<?php

/**
 * 应用于需要登录验证的控制器基类
 * @author CGY
 *
 */

namespace System\Controller;

abstract class BaseLoginController extends BaseController {
	
	
	/**
	 * 初始化
	 */
	protected function _initialize() {
		parent::_initialize();
		// 检查用户登录状态
		$this->assign('currUser', $this->currUser);
		if(! $this->isLogined) {
			exit('<script>top.location.href="' . U('Public/login') . '";</script>');
		}
		
	}
	
	

}