<?php
/**
 * 数据模型：通告
 * @author WZH
 *
 */
namespace Common\Model;
class NoticeModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('content','require','公告名称不能为空',self::MUST_VALIDATE,''),
		array('noticeKey','require','通知Key不能为空',self::MUST_VALIDATE,''),
/* 		array('name','require','名称不能为空！',self::MUST_VALIDATE,''),
		array('courseId','require','课程不能为空！',self::MUST_VALIDATE,''),
		array('status',array(0,1),'请选择正确的状态！',self::MUST_VALIDATE,'in'), */
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);

	//---------------扩展CRUD-----------------------
	/**
	 * 按页读取数据并把数据中的
	 * @param array $param 选择参数 格式:请参考initSelectParam方法;
	 * @param bool $isTotal 是否返回总记录数
	 */
	public function queryNotice($param='',$isTotal=true){
		$this->initSelectParam($param);
		$list['rows'] = $this->where($param['where'])->field($param['field'],$param['fieldExcept'])->order($param['sortOrder'])->page($param['page'],$param['pageSize'])->select();
		if($isTotal) $list['total'] = $this->where($param['where'])->count();
		return $this->returnListData($list);
	}
	
	/**
	 * 更新缓存（全部：NO,$exKey：YES）
	 * @param string $exKey 父栏目id
	 */
	public function updateCache($exKey=''){
		
	}
	
}