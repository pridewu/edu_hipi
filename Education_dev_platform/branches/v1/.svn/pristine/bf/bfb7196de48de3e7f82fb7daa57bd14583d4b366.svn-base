<?php
/**
 * 控制器：活动
 * @author FYW
 *
 */
namespace System\Controller;
class ActivityController extends BaseAuthController {
	
	
	private $actTypes = array('投票','抽奖');
		
	/**
	 * 查看操作
	 */
	public function indexAct() {
		if(! IS_POST) {
			$this->assign(array(
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del')),
				'actTypeHtml' => $this->getComboBox($this->actTypes, 'where[actType]',array('selVal'=>-1)),
				'statusHtml' => $this->getComboBox($this->statusNames,'where[status]',array('selVal'=>-1)),
			));
			$this->display();
		} else {
			$data = D('Activity')->selectPage($this->getSelectParam());
			foreach($data['rows'] as $key=>$row){
				$data['rows'][$key]['actType'] = $this->actTypes[$row['actType']];
			}
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
        if(!IS_POST){
            $id = I('id','');
            $this->assign('id', $id);
            $this->display();
        }else{
            $this->showResult( D('Activity')->delData(I('post.','')));
        }
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$activity = D( 'Activity')->find($id);
				$activity['rule'] = unserialize($activity['rule']);
				foreach($activity['rule'] as $key=>$val){
					$tmp[] = $key.'='.$val; 
				}
				$activity['rule'] = implode("\r\n",$tmp);	
				$activity['imgUrl'] = str_replace(',', "\r\n", $activity['imgUrl']);
			}else{
				$activity['actType']=0;
				$actovotu['statis'] = 1;
			}
			$this->assign(array(
				'activity' => $activity,	
				'actTypeHtml' => $this->getComboBox($this->actTypes, 'actType',array('selVal'=>$activity['actType'],'nullText'=>'','editable'=>true)),
				'statusHtml'=> $this->getComboBox($this->statusNames, 'status',array('selVal'=>$activity['status'],'nullText'=>'')),
			));	
			$this->display( 'edit');
		} else {
			$data = I('post.');
			$data['rule'] = explode("\r\n", $data['rule']);
			foreach($data['rule'] as $val){				
				$tmp = explode('=', $val);
				if($tmp[0]) $newRule[$tmp[0]] = $tmp[1];		
			}
			$data['rule'] = $newRule;
			$data['imgUrl'] = str_replace("\r\n", ',', $data['imgUrl']);
			$this->showResult( D( 'Activity')->saveData($data));
		}
	}

}