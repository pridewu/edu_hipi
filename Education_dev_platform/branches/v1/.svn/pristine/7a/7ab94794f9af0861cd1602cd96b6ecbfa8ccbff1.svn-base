<?php
/**
 * 控制器：系统角色管理
 * @author CGY
 *
 */

namespace System\Controller;

class SysUserController extends BaseAuthController {
	
	/**
	 * 查看操作
	 */
	public function indexAct() {
		$roles = get_cache('SysRole');
		if(! IS_POST) {
			$this->assign(array(
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del')),
				'roleHtml'	=> $this->getComboBox($roles, 'where[roleId]'),					
			));
			$this->display();
		} else {						
			$data = D( 'SysUser')->selectPage(I('post.'));
			foreach($data['rows'] as $key=>$row){
				$data['rows'][$key]['roleName'] = $roles[$row['roleId']];
			}
			$this->ajaxReturn( $data);
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
		$this->showResult( D( 'SysUser')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑管理员
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$user = M('SysUser')->find($id);
			}else{
				$user['status'] = 1;
			}
			$roleHtml = $this->getComboBox( get_cache( 'SysRole'), 'roleId', array('selVal'=>$user ['roleId']));
			$this->assign(array(
				'user' => $user,
				'roleHtml' => $roleHtml,
				'statusHtml'=> $this->getComboBox($this->statusNames, 'status',array('selVal'=>$user['status'],'nullText'=>'')),
			));
			$this->display( 'edit');
		} else {
			$this->showResult( D( 'SysUser')->saveData( I('post.')));
		}
	}

}