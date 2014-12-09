<?php
/**
 * 控制器：系统角色管理
 * @author CGY
 *
 */
namespace System\Controller;

class SysRoleController extends BaseAuthController {
	
	/**
	 * 查看操作
	 */
	public function indexAct() {
		if(! IS_POST) {
			$this->assign('buttonStyle',$this->buttonAuthStyle(array('add','edit','del')));
			$this->display();
		} else {
			$data = D('SysRole')->selectPage(I('post.'));			
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
		$this->showResult( D('SysRole')->delData(I('id')));
	}
	
	/**
	 * 添加 / 编辑角色
	 */
	private function set() {		
		if(! IS_POST) {	
			$id = I('id', 0);
			if($id > 0) {
				$role = M('SysRole')->find($id);
				$role ['auth'] = unserialize($role ['auth']);
			}
			$this->assign(array(					
				'role'=> $role,
				'authStructure' => get_auth_structure(),
			));
			$this->display('edit');
		} else {
			$this->showResult(D('SysRole')->saveData(I('post.')));
		}
	
	}

}