<?php
/**
 * 控制器：知识点
 * @author CGY
 *
 */
namespace System\Controller;
class TopicController extends BaseAuthController {
	
	
	/**
	 * 查看操作
	 */
	public function indexAct() {
		if(!IS_POST) {
			$statusHtml = $this->getComboBox($this->statusNames, 'status',array('selVal'=>'-1','nullText'=>'请选择','width'=>80));
			$this->assign(array(			
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del')),
				'statusHtml'  => $statusHtml,			
			));
			$this->display();
		} else {
			$param['where'] = I('post.');
			$param['sortOrder'] = 'sort asc';
			$list = D('Topic')->selectPage($param);
			$list = array_values($list['rows']);
			$this->ajaxReturn($list);
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
		$this->showResult( D('Topic')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$topic = D('Topic')->find($id);
			}else{
				$topic['status'] = 1; //状态默认为启用
			}	
			$statusHtml = $this->getComboBox($this->statusNames, 'status',array('selVal'=>$topic['status'],'nullText'=>'','width'=>150));
			
			$this->assign(array(
				'topic'  => $topic,
				'statusHtml'  => $statusHtml,
			));	
			$this->display( 'edit');
		} else {
			$data = I('post.');
			$this->showResult( D('Topic')->saveData($data));
		}
	}
}