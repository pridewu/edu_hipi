<?php
/**
 * 控制器：文件上传
 * @author CGY
 *
 */
namespace System\Controller;
class UpfileController extends BaseAuthController {
	
    protected $fileType = array(1=>'image',2=>'J2ME',3=>'Other');

	/**
	 * 附件管理首页
	 */
    public function indexAct() {
        if(!IS_POST){
            $buttonStyle = $this->buttonAuthStyle(array('edit','del'));
            $buttonStyle['add'] = 'style="display:none;"';
            $this->assign(array(
				'buttonStyle' => $buttonStyle,
            ));
            $this->display();
        }else{
            $data = D('Upfile')->selectPage($this->getSelectParam());
            foreach ($data['rows'] as $key => $value) {
                $data['rows'][$key]['fileType'] = $this->fileType[$value['fileType']];
                $data['rows'][$key]['realUrl'] = get_upfile_url($value['url']);
            }
            $this->ajaxReturn($data);
        }
    }
    
    /**
     * 编辑附件
     */
    public function editAct() {
        if(!IS_POST){
            $id = I('id','');
            $upfile = D('Upfile')->find($id);
            $upfile['fileType'] = $this->fileType[$upfile['fileType']];
            $this->assign(array(
				'upfile' => $upfile,
            ));
            $this->display();
        }else{
            $this->showResult(D('Upfile')->saveData(I('post.','')));
        }
    }
    
    /**
     * 删除附件
     */
    public function delAct() {
        if(!IS_POST){
            $id = I('id','');
            $upfile = D('Upfile')->find($id);
            $this->assign(array(
                'upfile' => $upfile,
            ));
            $this->display();
        }else{
            $this->showResult( D('Upfile')->delData(I('post.','')));
        }
    }
    
    /**
     * 统计附件大小
     */
    public function countAct(){
        $where = $this->getSelectParam();
        $total = D('Upfile')->where($where['where'])->count();
		$sizeCount = (int)D('Upfile')->where($where['where'])->sum('size');
        $sizeKB = $sizeCount/1024;
        $sizeM = $sizeCount/(1024*1024);
		$this->ajaxReturn(result_data(1,'<div style="text-align:center;">总共'.$total.'个文件<br />附件大小：'.$sizeKB.' KB<br/>('.$sizeM.' M)</div>'));
	}
    
	/**
	 * 附件上传
	 */
	public function upfileAct(){
		$fileType = I('fileType',0);		
		$memo = I('memo','');
		$thumb = I('thumb','');
		
		/* 检查文件类型，并确定文件类型名称和扩展名  */
		$fileTypes = C('UPFILE_FILE_TYPE'); 
		if(!isset($fileTypes[$fileType])) $this->showResult(result_data(0,'参数错误：上传文件类型未指定！'));	
		$typeName = $fileTypes[$fileType]['name'];
		$exName = $fileTypes[$fileType]['exName'];
		
		if(!IS_POST){				
			$this->assign(array(
				'isMore'	=> I('isMore',0),
				'fileType'	=> $fileType,
				'typeName'	=> $typeName,
				'exName'	=> $exName,
				'memo'		=> $memo,
				'thumb' 	=> $thumb,
			));			
			$this->display();			
		}else{	
			/* 文件上传 */		
			$upload = new \Org\Net\UploadFile(); // 实例化上传类
			$this->setThumbParam($fileType, $thumb, $upload);//如果文件类型为图片，并设置了缩略图，则解析缩略图的尺寸
			$upload->allowExts  = explode(',',$exName); 	//设置附件上传类型
            $upload->savePath = C('UPFILE_LOCAL_PATH').'/'; //设置附件上传目录			
			$upload->autoSub = true;
			$upload->subType = 'hash';
			$upload->hashLevel = 1;
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->showResult(result_data(0,$upload->getErrorMsg()));
			}else{// 上传成功 获取上传文件信息
				$infos =  $upload->getUploadFileInfo();
			}
			
			/* 文件上传成功则把上传记录保存到数据库中 */
			$files = $this->saveData($infos, $fileType, $thumb, $memo);
			
			$this->showResult(result_data(1,'文件上传成功！',array('files'=>implode(',',$files))));			
		}
		
	}
	
	/**
	 * 设置图片缩略图参数
	 * @param $fileType
	 * @param $thumb
	 * @return array
	 */
	private function setThumbParam($fileType,$thumb,&$upload)
	{
		if($fileType==1){
			if(!empty($thumb)){
				$sizes = explode(',', $thumb);
				foreach($sizes as $size){
					list($suffix,$wh) = explode('=',$size);
					list($width,$height) = explode('*', $wh);
					if(empty($suffix) || !is_numeric($width) || !is_numeric($height) || $width<=0 || $height<=0){
						$this->showResult(result_data(0,'参数错误：缩略图大小格式不正确！'));
					}else{
						$suffixs[] = '_'.$suffix; //后缀
						$widths[] = (int)$width; //宽
						$heights[] = (int)$height; //高
					}
				}
				if(!empty($widths)){
					$upload->thumbMaxWidth = implode(',',$widths);
					$upload->thumbMaxHeight = implode(',',$heights);
					$upload->thumb = true;
					$upload->thumbPrefix = '';
					$upload->thumbSuffix = implode(',',$suffixs);
				}
			}
		}
	}

	/**
	 * 保存上传记录到数据库中
	 * @param arr $infos
	 * @param int $fileType
	 * @param arr $thumb
	 * @param string $memo
	 * @return array 上传的文件名列表
	 */
	private function saveData($infos,$fileType,$thumb,$memo){
		$Upfile = D('Upfile');
		foreach($infos as $info){
			$data = array(
					'fileType'	=> $fileType,
					'url'		=> $info['savename'],
					'size'		=> $info['size'],
					'thumb'		=> $thumb,
					'memo'		=> $memo,
			);
			if($Upfile->create($data)){
				$Upfile->add();
			}else{
				$this->showResult(result_data(0,$Upfile->getError()));
			}
			$files[] = $info['savename'];
		}
		return $files;
	}
}