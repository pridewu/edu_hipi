<?php
/**
 * 控制器：广告
 * @author CalvinXu
 *
 */
namespace System\Controller;
class AdController extends BaseAuthController {
    private $adClassNames = array('内部广告','外部广告');
	private $adTypeNames	= array('图片广告','视频广告');	
	
	/**
	 * 查看操作
	 */
	public function indexAct() {
        $proConfig = get_cache('ProConfig_p*config');
		if(!IS_POST) {
			$this->assign(array(
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del')),
				'adSpaceHtml' => $this->getComboBox(get_cache('AdSpace'),'where[asId]',array('valKey'=>'id','textKey'=>'title')),
				'adClassHtml' => $this->getComboBox($this->adClassNames,'where[adClass]',array('selVal'=>-1,'width'=>80)),
				'adTypeHtml' => $this->getComboBox($this->adTypeNames,'where[adType]',array('selVal'=>-1,'width'=>80)),
				'apHtml' => $this->getComboBox($proConfig['content']['ap'],'where[apId]',array('width'=>100)),
				'statusHtml' => $this->getComboBox($this->statusNames,'where[status]',array('selVal'=>-1,'width'=>60)),
			));
			$this->display();
		} else {		
			$data = D('Ad')->selectPage($this->getSelectParam('id','asKey'));
			$adSpaces = get_cache('AdSpace');
            //print_r($adSpaces);
			foreach($data['rows'] as $key=>$row){
				$data['rows'][$key]['asId'] = $adSpaces[$row['asId']]['title'];
                $data['rows'][$key]['apId'] = $proConfig['content']['ap'][$row['apId']];
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
		$this->showResult( D('Ad')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$ad = D( 'Ad')->find($id);
			}else{
				$ad['adClass'] = $ad['adType']='0';
				$ad['status']=1;
			}
            $proConfig = get_cache('ProConfig_p*config');
			$this->assign(array(
				'ad' => $ad,
				'adSpaceHtml' => $this->getComboBox(get_cache('AdSpace'),'asId',array('selVal'=>$ad['asId'],'valKey'=>'id','textKey'=>'title')),
				'adClassHtml' => $this->getComboBox($this->adClassNames,'adClass',array('selVal'=>$ad['adClass'],'nullText'=>'','editable'=>true)),
				'adTypeHtml' => $this->getComboBox($this->adTypeNames,'adType',array('selVal'=>$ad['adType'],'nullText'=>'','editable'=>true)),
				'apHtml' => $this->getComboBox($proConfig['content']['ap'],'apId',array('selVal'=>$ad['apId'],'editable'=>true)),
				'statusHtml' => $this->getComboBox($this->statusNames,'status',array('selVal'=>$ad['status'],'nullText'=>'','editable'=>true)),
			));	
			$this->display( 'edit');
		} else {
			$data = I('post.');
			$data['content'] = $data['adType']==1 ? $data['video'] : $data['image'];
			unset($data['image']);
			unset($data['video']);
			$this->showResult( D( 'Ad')->saveData($data));
		}
	}
}