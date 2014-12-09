<?php
/**
 * 数据模型：上传文件/附件
 * @author CGY
 *
 */
namespace Common\Model;
class UpfileModel extends BaseModel {
	
	//数据验证
	protected $_validate = array(
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('fileType','require','文件类型不能为空！',self::MUST_VALIDATE,''),	
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);		
	
	//默认排序字段
	protected  $sortOrder = 'id desc';
    
    public function delData($data) {
        if(!$data['id']) return result_data (0, '附件不存在！');
        $result = parent::delData($data['id']);
        if($result['status'] == 1){
            if($data['delFile'] == 'on'){//删除本身附件
                $url = get_upfile_url($data['url']);
                $result2 = unlink($url);
                if(!$result2){
                    return result_data(0, '本身文件删除失败！');
                }
            }
        }
        return $result;
    }
}