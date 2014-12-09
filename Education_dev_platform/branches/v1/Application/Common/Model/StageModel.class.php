<?php
/**
 * 数据模型：龄段
 * @author CGY
 *
 */
namespace Common\Model;
class StageModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('name','require','标题不能为空！',self::MUST_VALIDATE,''),
		array('sKey','require','关键字不能为空！',self::MUST_VALIDATE,''),
		array('chId','require','顶级分类不能为空！',self::MUST_VALIDATE,''),
		array('sKey','','该关键字已存在！',self::EXISTS_VALIDATE,'unique'),
		array('status',array(0,1),'请选择正确的状态！',self::MUST_VALIDATE,'in'),
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);

	//数据同步(子项)
	protected $sync = 'Stage';
	
	//---------------扩展CRUD-----------------------
	/**
	 * 更新缓存（全部：NO,$exKey：YES）
	 * @param string $exKey 父栏目id
	 */
	public function updateCache($exKey=''){
		$list = D('Stage')->selectPage(array('status'=>1));
		foreach ($list['rows'] as $k => $v){
			$data[$v['id']] = $v;
		}
		S('Stage',$data);
	}
	
}