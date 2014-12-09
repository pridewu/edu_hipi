<?php
/**
 * 控制器：课程
 * @author CGY
 *
 */
namespace System\Controller;
class CourseController extends BaseAuthController{
	
	
	/**
	 * 查看操作
	 */
	public function indexAct() {		
		if(!IS_POST) {
			//栏目和龄段
	  		$classes = $this->getClass();
			$channelHtml = $this->getComboBox($classes, 'chId',array('selVal'=>'','valKey'=>'id','textKey'=>'name','levelKey'=>'','nullText'=>'请选择','width'=>120)); 
 			$stageHtml = $this->getComboBox(get_cache('Stage'), 'stageId',array('selVal'=>'','valKey'=>'id','textKey'=>'name','levelKey'=>'','nullText'=>'请选择','width'=>120));
			
			//出版商，册数，课程类型,关键字
 			$proConf = get_pro_config_content('proConfig');
			$pressHtml  	= $this->getComboBox($proConf['press'], 'pressId',array('selVal'=>'','nullText'=>'请选择','width'=>120));
			$typeHtml   	= $this->getComboBox($proConf['courseType'], 'typeId',array('selVal'=>'','nullText'=>'请选择','width'=>120));
			$keysHtml   	= $this->getComboBox($proConf['keys'], 'keys',array('selVal'=>'','nullText'=>'请选择','width'=>120));
			$subjectHtml   	= $this->getComboBox($proConf['subject'], 'subject',array('selVal'=>'','nullText'=>'请选择','width'=>120));
					
			$statusHtml = $this->getComboBox($this->statusNames, 'status',array('selVal'=>'-1','nullText'=>'请选择','width'=>120));
 		
			$this->assign(array(			
				'buttonStyle'	=> $this->buttonAuthStyle(array('add','edit','del')),
				'channelHtml'	=> $channelHtml,
				'stageHtml'		=> $stageHtml,	
				'pressHtml'		=> $pressHtml,
				'typeHtml'		=> $typeHtml,
				'keysHtml'		=> $keysHtml,
				'subjectHtml'   => $subjectHtml,
				'statusHtml'	=> $statusHtml,						
			));
			$this->display();
		} else {
			$param['where'] = I('post.');
			$param['sortOrder'] = 'sort asc';
			$list = D('Course')->queryCourse($param);
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
		$this->showResult( D('Course')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$course = D('Course')->find($id);
			}else{
				$course['status'] = 1; //状态默认为启用
			}	
			//栏目和龄段
			$classes = $this->getClass();
			$channelHtml = $this->getComboBox($classes, 'chId',array('selVal'=>$course['chId'],'valKey'=>'id','textKey'=>'name','levelKey'=>'','nullText'=>'请选择','width'=>150));
			$stageHtml = $this->getComboBox(get_cache('Stage'), 'stageId',array('selVal'=>$course['stageId'],'valKey'=>'id','textKey'=>'name','levelKey'=>'','nullText'=>'请选择','width'=>150));
			
			//出版商，册数，课程类型,关键字,科目,标签
			$proConf = get_pro_config_content('proConfig');
			$pressHtml  	= $this->getComboBox($proConf['press'], 'pressId',array('selVal'=>$course['pressId'],'nullText'=>'请选择','width'=>150));
			$sessionHtml 	= $this->getComboBox($proConf['session'], 'session',array('selVal'=>$course['session'],'nullText'=>'请选择','width'=>150));
			$typeHtml   	= $this->getComboBox($proConf['courseType'], 'typeId',array('selVal'=>$course['typeId'],'nullText'=>'请选择','width'=>150));
			$subjectHtml   	= $this->getComboBox($proConf['subject'], 'subject',array('selVal'=>$course['subject'],'nullText'=>'请选择','width'=>150));
			
			$statusHtml 	= $this->getComboBox($this->statusNames, 'status',array('selVal'=>$course['status'],'nullText'=>'','width'=>150));
			
			$this->assign(array(
				'course'	  => $course,
				'channelHtml' => $channelHtml,
				'stageHtml'   => $stageHtml,
				'pressHtml'   => $pressHtml,
				'sessionHtml' => $sessionHtml,
				'typeHtml'    => $typeHtml,
				'subjectHtml' => $subjectHtml,
				'statusHtml'  => $statusHtml,
			));	
			$this->display('edit');
		} else {
			$data = I('post.');
			$this->showResult( D('Course')->saveData($data));
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