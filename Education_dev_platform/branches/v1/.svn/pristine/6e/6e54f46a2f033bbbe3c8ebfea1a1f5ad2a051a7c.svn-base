<?php
/**
 * 数据模型：知识点
 * @author CGY
 *
 */
namespace Common\Model;
class TopicModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('name','require','名称不能为空！',self::MUST_VALIDATE,''),
		array('courseId','require','课程不能为空！',self::MUST_VALIDATE,''),
		array('sectionIds','require','课时ID列表不能为空！',self::MUST_VALIDATE,''),
		array('status',array(0,1),'请选择正确的状态！',self::MUST_VALIDATE,'in'),
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);

	//---------------扩展CRUD-----------------------
}