<?php

/**
 * 控制器：系统日志
 * @author CGY
 *
 */

namespace System\Controller;

class SysLogController extends BaseAuthController{
	
	/**
	 * 查看操作
	 */
	public function indexAct(){
		$id = I('id');
		if(empty($id)){
			if(!IS_POST){
				$buttonStyle =  $this->buttonAuthStyle(array('view','clear'));
				$buttonStyle['add'] = $buttonStyle['edit'] = $buttonStyle['del'] = 'style="display:none;"';
				$this->assign(array(
					'buttonStyle' => $buttonStyle,
					'sDate'	=> date('Y-m-1'),
					'eDate'	=> date('Y-m-d 23:59:59',strtotime(get_month_last($this->sDate))),
				));
				$this->display();
			}else{
				$this->ajaxReturn(D("SysLog")->selectPage(I('post.')));
			}
		}else{
			$log = M('SysLog')->find($id);
			$log['data'] = dump(unserialize($log['data']),false);
			$log['addTime'] = date('Y-m-d H:i:s',$log['addTime']);
			$this->assign('log',$log);
			$this->display('view');
		}
	}
	
	
	/**
	 * 清除一个月之前操作
	 */
	public function clearAct(){
		$result = D("SysLog")->clear();
		$this->showResult($result);
	}
	
}