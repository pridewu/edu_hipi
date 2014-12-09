<?php
/**
 * 控制器：平台用户
 * @author Administrator
 *
 */

namespace System\Controller;
class UserController extends BaseAuthController {
		
	/**
	 * 查看操作
	 */
	public function indexAct() {
		if( !IS_POST) {
			$buttonStyle = $this->buttonAuthStyle(array('edit'));
			$buttonStyle['add'] = $buttonStyle['del'] = 'style="display:none;"';
			$this->assign(array(
				'buttonStyle' => $buttonStyle,
			)); 
			$this->display();
		} else {
            $where = I('post.','');
            $beginTime = I('beginTime','');
            if(!empty($beginTime)){
                $beginTime = $beginTime.' 00:00:00';
                $where['where']['addTime'] = array('egt',$beginTime);
            }
            $endTime = I('endTime','');
            if(!empty($endTime)){
                $endTime = $endTime.' 23:23:59';
                $where['where']['addTime2'] = array('elt',$endTime);
            }
			$this->ajaxReturn( D('User')->selectPage($where));
		}
	}
	
	
	/**
	 * 编辑操作
	 */
	public function editAct() {
		if(!IS_POST){
			$id = I('id',0);
			if(empty($id)) $this->showResult(result_data(0,'用户参数错误！'));			
			$user = D('User')->find($id); //用户信息
			if(empty($user)) $this->showResult(result_data(0,'用户不存在！'));
			$this->assign(array(
				'user' => $user,
			));	
			$this->display('edit');
		}else{
			$user = I('post.');	
			$result = D('User')->saveData($user);
			if(!$result['status']) $this->showResult($result);			
			$this->showResult($result);
		}
	}
	
    public function countAct() {
        $where = array();
        $beginTime = I('beginTime','');
        if(!empty($beginTime)){
            $beginTime = $beginTime.' 00:00:00';
            $where['where']['addTime'] = array('egt',$beginTime);
        }
        $endTime = I('endTime','');
        if(!empty($endTime)){
            $endTime = $endTime.' 23:23:59';
            $where['where']['addTime2'] = array('elt',$endTime);
        }
        $userId = I('userId','');
        if(!empty($userId)){
            $where['where']['$userId'] = $userId;
        }
        $userCount = D('User')->selectPage($where);
        $this->ajaxReturn(result_data(1,'<div style="text-align:center;">用户个数：'.$userCount['total'].'</div>'));
    }

}