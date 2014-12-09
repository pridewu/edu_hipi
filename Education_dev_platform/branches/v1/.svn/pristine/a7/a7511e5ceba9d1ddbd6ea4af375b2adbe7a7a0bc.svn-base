<?php
/**
 * 数据模型：用户信息
 */
namespace Common\Model;
class UserModel extends BaseModel {	
	
	
	
	//数据验证
	protected $_validate = array(
		//插入
		array('userId','require','用户ID不能为空！',self::MUST_VALIDATE,'',self::MODEL_INSERT),	
		//全部			
		array('userId','','用户ID已存在！',self::EXISTS_VALIDATE,'unique'),
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),
	);
	
	//默认排序字段
	protected  $sortOrder = 'id desc';
	
	//---------------扩展CRUD-----------------------
	
	
	/**
	 * 重写像类initWhere
	 * @see Common\Model.BaseModel::initWhere()
	 */
	protected function initWhere($condition){
		if(!is_empty_null($condition['userId'])) $where['userId'] = $condition['userId'];
		if(!empty($condition['userToken'])) $where['userToken'] = $condition['userToken'];
		if(!empty($condition['userName'])) $where['userName'] = $condition['userName'];
		return $where;
	}
	
	/**
	 * 增加或减少某项值
	 * @param int $userId
	 * @param array $data
	 */
	public function SetIncOrDec($userId,$data){		
		$rows = $this->where(array('userId'=>$userId))->setField($this->getIncOrDecData($data));
		return result_data(1,'数据更新成功！',array('rows'=>$rows));
	}
	
	/**
	 * 删除数据(如果某模型不想有删除方法，可在子类中重写)
	 * @param unknown_type $id
	 */
	public function delData($id){
		//用户表不允许删除		
	}
	
}