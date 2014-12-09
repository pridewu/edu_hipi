<?php
/**
 * 数据模型：资源
 * @author CGY
 *
 */
namespace Common\Model;
class ResourceModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('title','require','标题不能为空！',self::MUST_VALIDATE,''),
		array('content','require','视频流code不能为空！',self::MUST_VALIDATE,''),
		array('rpId','require','所属于资源商ID不能为空',self::MUST_VALIDATE,''),
		array('outId','require','外部统一编号不能为空',self::MUST_VALIDATE,''),
		array('libUrl','require','资源路径不能为空',self::MUST_VALIDATE,''),
		array('sort','require','资源排序不能为空',self::MUST_VALIDATE,''),
		array('status',array(0,1),'请选择正确的状态！',self::MUST_VALIDATE,'in'),
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);
	
	/**
	 * 重写像类initWhere
	 * @see Common\Model.BaseModel::initWhere()
	 */
	protected function initWhere($condition){
		if(!is_empty_null($condition['id'])) $where['id'] = $condition['id'];
		//资源商
		if(!empty($condition['rpId'])) $where['rpId'] = $condition['rpId'];
		//关键字标签
		if($condition['keyList'][0] == 'notlike'){
			if(is_array($condition['keyList'][1])){
				for($i=0;$i<count($condition['keyList'][1]);$i++){
					$where['_string'] .= ' (`keyList` not like "%'.$condition['keyList'][1][$i].'%")  AND ( `title` not like "%'.$condition['keyList'][1][$i].'%") AND';
				}
				$where['_string'] = substr($where['_string'],0,strlen($where['_string'])-3);
			}else{
				$where['_string'] = $condition['keyList'][1];
			}
		}else if(is_array($condition['keyList'])){
			for($i=0;$i<count($condition['keyList']);$i++){
				$where['_string'] .= ' (`keyList` like "%'.$condition['keyList'][$i].'%")  OR ( `title` like "%'.$condition['keyList'][$i].'%") OR';
			}
			$where['_string'] = substr($where['_string'],0,strlen($where['_string'])-2);
		}elseif(!empty($condition['keyList'])){
			$where['_string'] = ' (`keyList` like "%'.$condition['keyList'].'%")  OR ( `title` like "%'.$condition['keyList'].'%") ';
		}
	
		//阅读权限
		if(!is_empty_null($condition['playAuth'])) $where['playAuth'] = $condition['playAuth'];
		//标记
		if(!empty($condition['flags'])) $where['_string'] = ($where['_string'] ? ' and ': ''). " find_in_set('".$condition['flags']."',flags)";
		//状态
		if(!is_empty_null($condition['status'])) $where['status'] = $condition['status'];
		return $where;
	}
}