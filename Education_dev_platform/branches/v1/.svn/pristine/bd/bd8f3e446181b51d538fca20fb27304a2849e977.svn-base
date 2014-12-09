<?php

/**
 * 控制器：公共页面
 * @author CGY
 *
 */

namespace System\Controller;

class PublicController extends \Think\Controller{
	
	/**
	 * 登录页
	 */
	public function loginAct() {
		
	
		$loginNum = session("system_login_num");
		
		
		$loginNum = $loginNum === null ? 5 : $loginNum;
		
		if(! IS_POST) {
			$this->display();
		} else {
			$loginNum --;
			session("system_login_num", $loginNum);
			if($loginNum <= 0)
				$this->error("由于您输入错误过多，请30分钟后再试！");
			$name = I('userName', '');
			$password = I('password', '');
			if(empty($name) || empty($password))
				$this->error("用户名或密码错误！您还有 $loginNum 次机会。");
			$user = D('SysUser')->login($name, $password);
			if(! $user)
				$this->error("用户名或密码错误！您还有 $loginNum 次机会。");
			$currUser = authcode(serialize(array('id' => $user ['id'], 'lastTime' => $user ['lastTime'], 'lastIp' => $user ['lastIp'])),'ENCODE');
			session('system_curr_user', $currUser);
			session('system_login_num', null);
			$this->success($name . "，您好！点击确定按钮进入系统。", U("Index/index"));
		}
	}
	
	/**
	 * 注销退出
	 */
	public function logoutAct() {
		session('system_curr_user', null);
		$this->show('<script>top.location.href="' . U('Public/login') . '";</script>');
	}

}