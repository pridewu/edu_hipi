<?php
/**
 * 数据模型：题库
 * @author CGY
 *
 */
namespace Common\Model;
class LibraryModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('title','require','标题不能为空！',self::MUST_VALIDATE,''),
		//array('rpId','require','所属于资源商ID不能为空',self::MUST_VALIDATE,''),
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
		//题库权限
		if(!is_empty_null($condition['auth'])) $where['auth'] = $condition['auth'];
		//状态
		if(!is_empty_null($condition['status'])) $where['status'] = $condition['status'];
		return $where;
	}
	
}