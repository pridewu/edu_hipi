<?php
/**
 * 控制器：缓存
 * @author CGY
 *
 */

namespace System\Controller;

class CacheController extends BaseAuthController {
	
	/**
	 * 批量更新缓存
	 */
	public function updateAct(){
		$cacheList = C('CACHE_LIST');
		$errMsg = '';
		if(! IS_POST){
			$this->assign('listHtml',$this->getComboBox($cacheList, 'id',array('nullText'=>'全部缓存')));
			$this->display();			
		}else{
			$id = I('post.id','');
			if(!empty($id)){
				if(!isset($cacheList[$id])){
					$this->showResult(result_data(0,'请选择您要更新的缓存！'));
				}
				$cacheList = array($id=>$cacheList[$id]);
			}			
			foreach($cacheList as $key=>$c){
				$obj = D($key);
				if(method_exists($obj,'updateCache')){
					$obj->updateCache();
					$msg .= $c.'缓存更新成功<br/>';
				}else{
					$msg .= '<font color=red>'.$c.'缓存更新失败</font><br/>';
				}					
			}
			$this->showResult(result_data(1,$msg));
		}			
	}

}