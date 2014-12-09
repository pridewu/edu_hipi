<?php
/**
 * 数据模型：活动
 */
namespace Common\Model;
class ActivityModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		//插入
		
		//更新
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
        
        //全部
		array('title','require','活动标题不能为空',self::EXISTS_VALIDATE,''),
		array('actType',array(0,1),'活动类型不能为空',self::EXISTS_VALIDATE,'in'),
		array('rule','require','规则不能为空',self::EXISTS_VALIDATE,''),
		array('beginTime','require','活动起始时间不能为空',self::EXISTS_VALIDATE,''),
		array('endTime','require','活动结束时间不能为空',self::EXISTS_VALIDATE,''),
		array('status',array(0,1),'活动状态不能正确',self::EXISTS_VALIDATE,'in'),
		
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);


	//默认排序字段
	protected  $sortOrder = 'sort,endTime desc';
	//数据同步(子项)
	protected $sync = 'Activity';
	
	//---------------扩展CRUD-----------------------
		
	/**
	 * 重写像类initWhere
	 * @see Common\Model.BaseModel::initWhere()
	 */
	protected function initWhere($condition){
		if(!is_empty_null($condition['id'])) $where['id'] = $condition['id'];		
		if(!is_empty_null($condition['actType'])) $where['actType'] = $condition['actType'];
		if(!empty($condition['classKey'])) $where['classKey'] = $condition['classKey'];
        if(!empty($condition['endTime'])) $where['endTime'] = $condition['endTime'];        
		if(in_array($condition['status'],array('0','1'))) $where['status'] = $condition['status'];		
		return $where;
	}
		
	
	public function saveData($data){
		if(is_array($data['rule'])) $data['rule'] = serialize($data['rule']);
        //创建表
        $result = parent::saveData($data);
        if(!$data['id']){
            if($result['status'] == 1){
                //$result2 = D('ActBase','Logic')->createActTable($result['data']['id']);
                //if($result2['status'] == 0){
                    //return result_data(0, $result2['info']);
                //}
            }
        }
        return $result;
	}
	
    public function delData($data) {
        if(!$data['id']) return result_data (0, '活动不存在！');
        $result = parent::delData($data['id']);
        if($result['status'] == 1){
            if($data['delTable'] == 'on'){//删除表
                $result2 = D('ActBase','Logic')->delActTable($data['id']);
                if($result2['status'] == 0){
                    return result_data(0, $result2['info']);
                }
            }
        }
        return $result;
    }
    
	/**
	 * 更新缓存（全部：NO,$exKey：YES）
	 * $exKey = proId(有效状态) 	 
	 */	
	public function updateCache(){
		$list = $this->order($this->sortOrder)->select();
		foreach($list as $key=>$row){
			$datas[$row['id']] = $row;
		}
        S('Activity',$datas);
		
	}
	
}