<?php
/**
 * 数据模型：系统日志
 * @author CGY
 *
 */
namespace Common\Model;
class SysLogModel extends BaseModel {	
	

	//默认排序字段
	protected  $sortOrder = 'addTime desc';
	
	//---------------扩展CRUD-----------------------
	
		
	
	/**
	 * 重写像类initWhere
	 * @see Common\Model.BaseModel::initWhere()
	 */
	protected function initWhere($condition){
		if(!is_datetime($condition['sDate'])) $condition['sDate'] = date('Y-m-1');
		if(!is_datetime($condition['eDate'])) $condition['eDate'] = date('Y-m-d 23:59:59',strtotime(get_month_last($condition['sDate'])));
		$where['addTime'] = array('between',array(strtotime($condition['sDate']),strtotime($condition['eDate'])));
		if(!empty($condition['userName'])) $where['userName'] = $condition['userName'];
		if(!empty($condition['controller'])) $where['controller'] = $condition['controller'];
		if(!empty($condition['action'])) $where['action'] = $condition['action'];
		if(!empty($condition['data'])) $where['data'] = array('like','%'.$condition['data'].'%');
		return $where;
	}
	
	
	function clear(){
		$lDate = get_date_add('m',-1,date('Y-m-d H:i:s'));
		$where = 'addTime <'. strtotime($lDate);
		$this->where($where)->delete();
		return result_data(1,'一个月前的数据清除成功');
	}
}