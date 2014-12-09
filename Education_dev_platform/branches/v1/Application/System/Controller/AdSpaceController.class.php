<?php
/**
 * 控制器：广告位
 * @author CalvinXu
 *
 */
namespace System\Controller;
class AdSpaceController extends BaseAuthController {
    public $asTypeNames = array('单图','轮播图','视频');
	
	/**
	 * 查看操作
	 */
	public function indexAct() {
		if(! IS_POST) {
			$this->assign(array(			
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del')),	
				'asTypeHtml' => $this->getComboBox($this->asTypeNames,'where[asType]',array('selVal'=>-1,'width'=>80)),
			));
			$this->display();
		} else {			
			$data = D('AdSpace')->selectPage($this->getSelectParam('id','asKey'));
			foreach($data['rows'] as $key=>$row){
				$data['rows'][$key]['asType'] = $this->asTypeNames[$row['asType']];
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
		$this->showResult( D('AdSpace')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$adSpace = D( 'AdSpace')->find($id);
			}
			$this->assign(array(
				'adSpace' => $adSpace,
				'asTypeHtml' => $this->getComboBox($this->asTypeNames,'asType',array('selVal'=>$adSpace['asType'],'nullText'=>'','editable'=>true)),
			));				
			$this->display( 'edit');
		} else {
			$this->showResult( D( 'AdSpace')->saveData(I('post.')));
		}
	}
}