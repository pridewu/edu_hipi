<?php
/**
 * 控制器：角色
 * @author WZH
 *
 */
namespace System\Controller;
class RoleController extends BaseAuthController{
	
	
	/**
	 * 查看操作
	 */
	public function indexAct() {		
		if(!IS_POST) {
				
			$statusHtml = $this->getComboBox($this->statusNames, 'status',array('selVal'=>'-1','nullText'=>'请选择','width'=>120));
			
			$this->assign(array(			
				'buttonStyle'	=> $this->buttonAuthStyle(array('add','edit','del')),
				'statusHtml'	=> $statusHtml,						
			));
			$this->display();
		} else {
			$param['where'] = I('post.');
			$list = D('Role')->queryRole($param);
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
		$this->showResult( D('Role')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$Role = D('Role')->find($id);
			}else{
				$Role['status'] = 1; //状态默认为启用
			}	
		
			$statusHtml = $this->getComboBox($this->statusNames, 'status',array('selVal'=>$Role['status'],'nullText'=>'','width'=>150));
			
			$this->assign(array(
				'Role'	  => $Role,
				'statusHtml'  => $statusHtml,
			));	
			$this->display('edit');
		} else {
			$data = I('post.');
			$this->showResult( D('Role')->saveData($data));
		}
	}
	
	/**
	 * 异步加载信息：龄段
	 */
	public function loadAct(){
		$type = I('get.type','');
		if($type == 'stage'){ //龄段
			$stages = get_cache('Stage');
			foreach ($stages as $k=>$v){
				$data[] = array('id'=>$v['id'],'name'=>$v['name']);
			}
			save_log('load',$data);
		}elseif($type == 'key'){ //关键字
			$proConf = get_pro_config_content('proConfig');
			foreach ($proConf['keys'] as $k => $v){
				$data[] = array('id'=>$k,'name'=>$v);
			}
		}
		
		$this->ajaxReturn($data);
	}
	
	/**
	 * 获取龄段顶级分类(顶级栏目-全部课程下的二级栏目)
	 * 先获取顶级栏目-全部课程，然后再获取全部课程下的二级栏目(顶级分类)
	 */
	private function getClass(){
		$channel = S('Channel');
		$topChannel = get_array_for_fieldval($channel, 'chKey','allcourse');
		$topChannel = array_slice($topChannel,0,count($topChannel));
		$id = $topChannel[0]['id'];
		$class = get_array_for_fieldval($channel, 'pId',$id);//二级栏目(顶级分类)
		return $class;
	}
}