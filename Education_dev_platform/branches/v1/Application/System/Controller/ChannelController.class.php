<?php
/**
 * 控制器：栏目
 * @author CGY
 *
 */
namespace System\Controller;
class ChannelController extends BaseAuthController {
	
	
	/**
	 * 查看操作
	 */
	public function indexAct() {		
		if(!IS_POST) {
			$this->assign(array(			
				'buttonStyle' => $this->buttonAuthStyle(array('add','edit','del','export')),	
			));
			$this->display();
		} else {
			$list = D('Channel')->queryChannel();
			$list['rows'] = array_values($list['rows']);
            foreach ($list['rows'] as $key => $value) {
                $navImgUrl = explode(",", $value['imgUrl']);
                $realNavImgUrl = array();
                foreach ($navImgUrl as $key2 => $value2) {
                   $realNavImgUrl[] = get_upfile_url($value2);
                    
                }
                $list['rows'][$key]['realNavImgUrl'] = implode(",", $realNavImgUrl);
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
		$this->showResult( D('Channel')->delData(I('id')));
	}
	
	/**
	 * 添加/编辑
	 */
	private function set() {		
		if(! IS_POST) {
			$id = I( 'id', 0);
			if($id > 0) {
				$channel = D('Channel')->find($id);
				$channel['imgUrl'] = str_replace(',', "\r\n",$channel['imgUrl']);	
				$channel['description'] = str_replace('<br/>', "\r\n",$channel['description']);										
			}else{
				$channel['status'] = 1; //状态默认为启用
				$channel['isShow'] = 1; //显示状态默认为显示
			}
					
			$this->assign(array(
				'channel'	=> $channel,
				'thumb'		=> '',
				'pIdHtml'	=> $this->getComboBox(get_array_val(D('Channel')->queryChannel(),'rows'),'pId',array('selVal'=>$channel['pId'],'valKey'=>'id','textKey'=>'name','levelKey'=>'level','nullText'=>'顶级栏目','width'=>300)),
				'statusHtml'=> $this->getComboBox($this->statusNames, 'status',array('selVal'=>$channel['status'],'nullText'=>'')),
				'showHtml'=> $this->getComboBox($this->isShow, 'isShow',array('selVal'=>$channel['isShow'],'nullText'=>'')),
			));	
			$this->display( 'edit');
		} else {
			$data = I('post.');
			$data['imgUrl'] = str_replace("\r\n", ',', $data['imgUrl']);
			$data['description'] = str_replace("\r\n", '<br/>',$data['description']);
			$this->showResult( D('Channel')->saveData($data));
		}
	}
    
    public function exportDataAct() {
        $filename = 'channel_'.date("YmdHis",NOW_TIME).'.txt';
        header( "Content-type:application/octet-stream "); 
        header( "Accept-Ranges:bytes "); 
        header( "Content-Disposition:attachment;filename=".$filename); 
        header( "Expires:0 "); 
        header( "Cache-Control:must-revalidate,post-check=0,pre-check=0 ");
        $list = D('Channel')->queryChannel(); 
        foreach ($list['rows'] as $key => $value) {
            $data = json_encode($value)."@@\n";
            echo $data;
        }
    }

}