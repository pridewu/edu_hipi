<?php
/**
 * 控制器：资源
 * @author CGY
 *
 */
namespace System\Controller;
class ResourceController extends BaseAuthController {
	
	
	/**
	 * 查看操作
	 */
	public function indexAct() {
        $proConfig = get_cache('ProConfig');		
		if(!IS_POST) {
			$this->assign(array(			
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del','export')),
				'rpHtml' => $this->getComboBox($proConfig['content']['rp'],'where[rpId]',array('width'=>100)),
				'statusHtml'=> $this->getComboBox($this->statusNames, 'where[status]',array('selVal'=>-1,'width'=>60)),	
			));
			$this->display();
		} else {
			$param = $this->getSelectParam('id','rpId');
            session('SEARCHCONDITION',$param);
			$list = D('Resource')->selectPage($param);
			$rp	= $proConfig['content']['rp'];
			foreach($list['rows'] as $key=>$row){
				$list['rows'][$key]['rpId'] = $rp[$row['rpId']];
				$list['rows'][$key]['status'] = $this->statusNames[$list['rows'][$key]['status']];
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
		$this->showResult( D('Resource')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$resource = D('Resource')->find($id);
				$resource['description'] = str_replace('<br/>', "\r\n",$resource['description']);										
			}else{
				$resource['status'] = 1; //状态默认为启用
				$resource['isShow'] = 1; //显示状态默认为显示
			}
			$proConfig = get_cache('ProConfig');
			$this->assign(array(
				'res'	=> $resource,
				'thumb'		=> '',
				'rpHtml' => $this->getComboBox($proConfig['content']['rp'],'rpId',array('selVal'=>$resource['rpId'],'width'=>200)),
				'statusHtml'=> $this->getComboBox($this->statusNames, 'status',array('selVal'=>$resource['status'],'nullText'=>'')),
			));	
			$this->display( 'edit');
		} else {
			$data = I('post.');
			$data['description'] = str_replace("\r\n", '<br/>',$data['description']);
			$this->showResult( D('Resource')->saveData($data));
		}
	}
}