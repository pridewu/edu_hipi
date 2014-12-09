<?php
/**
 * 控制器：龄段
 * @author CGY
 *
 */
namespace System\Controller;
class StageController extends BaseAuthController {
	
	
	/**
	 * 查看操作
	 */
	public function indexAct() {		
		if(!IS_POST) {
			$this->assign(array(			
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del')),	
			));
			$this->display();
		} else {
			$param['sortOrder'] = 'sort asc';
			$list = D('Stage')->selectPage($param);
			$list = array_values($list['rows']);
			
			//获取顶级分类(二级栏目)
			$class = $this->getClass();
			
			//把龄段所属顶级分类(二级栏目)的id转换成名称
			foreach ($list as $k => $v){
				$list[$k]['chId'] = $class[$list[$k]['chId']]['name'];
			}
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
		$this->showResult( D('Stage')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$stage = D('Stage')->find($id);
			}else{
				$stage['status'] = 1; //状态默认为启用
			}	
			
			$class = $this->getClass();	//获取顶级分类(二级栏目
			$classHtml = $this->getComboBox($class,'chId',array('selVal'=>$stage['chId'],'valKey'=>'id','textKey'=>'name','width'=>150));
			$statusHtml = $this->getComboBox($this->statusNames, 'status',array('selVal'=>$stage['status'],'nullText'=>''));
			
			$this->assign(array(
				'stage'		=> $stage,
				'classHtml'	=> $classHtml,
				'statusHtml'=> $statusHtml,
			));	
			$this->display( 'edit');
		} else {
			$data = I('post.');
			$this->showResult( D('Stage')->saveData($data));
		}
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