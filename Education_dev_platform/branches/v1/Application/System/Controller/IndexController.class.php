<?php

/**
 * 控制器：首页
 * @author CGY
 *
 */

namespace System\Controller;

class IndexController extends BaseLoginController {
	
	public function indexAct() {
		
		// 导航菜单
		$nav = get_auth_structure ( 'nav' );
		
		foreach ( $nav as $k1 => $v1 ) {
			foreach ( $v1 ['item'] as $k2 => $v2 ) {
				foreach ( $v2 ['item'] as $k3 => $v3 ) {
					$key = $k2 . '_' . $k3;
					// 根据权限显示菜单
					if (! $this->currUser ['isSuper'] && (! isset ( $this->currUser ['auth'] ['nav'] [$key] ) || ! $this->currUser ['auth'] ['nav'] [$key])) {
						unset ( $nav [$k1] ['item'] [$k2] ['item'] [$k3] );
					}
				}
				if (count ( $nav [$k1] ['item'] [$k2] ['item'] ) <= 0) {
					unset ( $nav [$k1] ['item'] [$k2] );
				}
			}
			if (count ( $nav [$k1] ['item'] ) <= 0) {
				unset ( $nav [$k1] );
			}
		}
		$this->assign ( array ('nav' => $nav ) );
		$this->display ();
	}
	
	/**
	 * 修改密码
	 */
	public function editpwdAct() {
		if (! IS_POST) {
			$this->display ();
		} else {
			$oldPassword = I ( 'post.oldPassword', '' );
			$password = I ( 'post.password', '' );
			$rePassword = I ( 'post.rePassword', '' );
			$result = D ( "SysUser" )->editpwd ( $this->currUser ['id'], $oldPassword, $password, $rePassword );
			$this->showResult ( $result );
		}
	}

}