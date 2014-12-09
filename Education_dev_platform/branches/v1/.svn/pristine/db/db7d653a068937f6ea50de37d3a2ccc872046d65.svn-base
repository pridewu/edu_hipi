<?php
/**
 * 数据模型：广告位
 */
namespace Common\Model;
class AdSpaceModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		//插入
		array('asKey','require','广告位关键字不能为空',self::MUST_VALIDATE,'',self::MODEL_INSERT),
		array('title','require','标题不能为空！',self::MUST_VALIDATE,'',self::MODEL_INSERT),
		array('showNum',array(0,10),'请输入广告数量（1-10）',self::MUST_VALIDATE,'between',self::MODEL_INSERT),
		//更新
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('asKey','require','广告位关键字不能为空',self::EXISTS_VALIDATE,'',self::MODEL_UPDATE),
		array('title','require','标题不能为空！',self::EXISTS_VALIDATE,'',self::MODEL_UPDATE),
		array('showNum',array(0,10),'请输入广告数量（1-10）',self::EXISTS_VALIDATE,'between',self::MODEL_UPDATE),
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);

	//默认排序字段
	protected  $sortOrder = 'id desc';
	//数据同步(子项)
	protected $sync = 'AdSpace';
	
	/**
	 * 重写像类initWhere
	 * @see Common\Model.BaseModel::initWhere()
	 */
	protected function initWhere($condition){
		if(!is_empty_null($condition['id'])) $where['id'] = $condition['id'];
		if(!empty($condition['asKey'])) $where['asKey'] = $condition['asKey'];
		if(!is_empty_null($condition['asType'])) $where['asType'] = $condition['asType'];
		return $where;
	}
	
		
	
	/**
	 * 更新缓存（全部：NO,$exKey：YES）
	 * $exKey = name_proId(无状态)|proId(有效状态)
	 */
	
	public function updateCache($exKey=''){
		$list = $this->order('id desc')->select();
		foreach($list as $key=>$row){
			$datas[$row['id']] = $row;
		}
        S('AdSpace',$datas);
        return $datas;
	}
	
}