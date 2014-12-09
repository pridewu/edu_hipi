<?php
/**
 * 数据模型：广告
 */
namespace Common\Model;
class AdModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		//插入
		array('asId','require','所属广告位不能为空',self::MUST_VALIDATE,'',self::MODEL_INSERT),
		array('adClass',array(0,1),'请选择正确的分类！',self::MUST_VALIDATE,'in',self::MODEL_INSERT),
		array('title','require','标题不能为空！',self::MUST_VALIDATE,'',self::MODEL_INSERT),
		array('adType',array(0,1),'请选择正确的类型！',self::MUST_VALIDATE,'in',self::MODEL_INSERT),
		array('status',array(0,1),'请选择正确的状态！',self::MUST_VALIDATE,'in',self::MODEL_INSERT),
		//更新
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('asId','require','所属广告位不能为空',self::EXISTS_VALIDATE,'',self::MODEL_UPDATE),
		array('adClass',array(0,1),'请选择正确的分类！',self::EXISTS_VALIDATE,'in',self::MODEL_UPDATE),
		array('title','require','标题不能为空！',self::EXISTS_VALIDATE,'',self::MODEL_UPDATE),
		array('adType',array(0,1),'请选择正确的类型！',self::EXISTS_VALIDATE,'in',self::MODEL_UPDATE),
		array('status',array(0,1),'请选择正确的状态！',self::EXISTS_VALIDATE,'in',self::MODEL_UPDATE),
		//全部
		
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);

	//默认排序字段
	protected  $sortOrder = 'sort,id desc'; 
	//数据同步(子项)
	protected $sync = 'Ad';
	
	
	//---------------扩展CRUD-----------------------
	
	
	/**
	 * 初始化条件
	 */
	protected function initWhere($condition){
		if(!is_empty_null($condition['id'])) $where['id'] = $condition['id'];
		if(!empty($condition['asId'])) $where['asId'] = $condition['asId'];
		if(!empty($condition['apId'])) $where['apId'] = $condition['apId'];
		if(!empty($condition['adId'])) $where['adId'] = $condition['adId'];
		
		if(!is_empty_null($condition['adClass'])) $where['adClass'] = $condition['adClass'];
		if(!is_empty_null($condition['adType'])) $where['adType'] = $condition['adType'];		
		if(!is_empty_null($condition['status'])) $where['status'] = $condition['status'];
		
		return $where;
	}
	
	/**
	 * 保存数据
	 * @param array $data
	 */
	public function saveData($data){		
		if($data['adClass']){
			if(!$data['apId']) return result_data(0,'广告商不能为空!');
			if(!$data['adId']) return result_data(0,'外部广告ID不能为空!');
		}else{
			$data['apId'] = '';
			$data['adId'] = '';
		}		
		return parent::saveData($data);
	}
	
	
	/**
	 * 更新缓存（全部：NO,$exKey：YES）
	 * $exKey = proId（有效状态） 
	 */
	
	public function updateCache(){
		$list = $this->where('status=1')->order('sort,id desc')->select();
		foreach($list as $key=>$row){
			$datas[$row['asId']][$row['id']] = $row;
		}
        S('Ad',$datas);
        return $datas;
	}
	
	
}