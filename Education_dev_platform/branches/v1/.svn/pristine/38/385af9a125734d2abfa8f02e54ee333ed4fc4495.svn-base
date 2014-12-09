<?php
/**
 * 数据模型：系统角色
 * @author CGY
 *
 */
namespace Common\Model;
class SysRoleModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		array('name','require','角色名称不能为空！',self::EXISTS_VALIDATE),
		array('name','','角色名称已存在！',self::EXISTS_VALIDATE,'unique'),
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),			
	);
	
		
	//---------------扩展CRUD-----------------------
	
	/**
	 * 按页读取数据
	 * @param array $param 选择参数 格式:请参考initSelectParam方法;	 
	 * @param bool $isTotal 是否返回总记录数
	 */
	public function selectPage($param='',$isTotal=true){
		$this->initSelectParam($param);
		if(!$param['field']) {
			$param['field']='auth';
			$param['fieldExcept']=true;
		}
		if(!$param['sortOrder']) $param['sortOrder'] = 'id asc';
		$list['rows'] = $this->where($param['where'])->field($param['field'],$param['fieldExcept'])->order($param['sortOrder'])->page($param['page'],$param['pageSize'])->select();
		if($isTotal) $list['total'] = $this->where($param['where'])->count();
		return $this->returnListData($list);
	}
	
	
	/**
	 * 重写像类initWhere
	 * @see Common\Model.BaseModel::initWhere()
	 */
	protected function initWhere($condition){
		if(is_numeric($condition['id'])){
			$where['id'] = $condition['id'];
		}elseif(is_array($condition['id'])){
			$where['id'] = array('in',implode($condition['id'],','));
		}elseif(!empty($condition['id']) && is_string($condition['id'])){
			$where['name'] = $condition['id'];
		}
		return $where;
	}
	
	
	/**
	 * 保存数据
	 * @param array $data
	 * @return Ambigous <multitype:, multitype:boolean unknown mixed >
	 */	
	public function saveData($data){
		$data = get_array_data($data, 'name,isSuper,auth', 'id');
		$data['auth'] = serialize($data['auth']);
		$data['isSuper'] = $data['isSuper']==1 ? 1 : 0;
		if($this->create($data)){
			if(empty($data['id'])){
				$id = $this->add();
			}else{
				$id = $this->save();
			}
			$this->updateCache();
			return result_data(1,'数据保存成功！',array('id'=>$id));
		}else{
			return result_data(0,$this->getError());
		}
	}

	
	
	/**
	 * 更新缓存
	 */
	public function updateCache(){
		$list = $this->field('id,name')->select();
		$data = array_replace_keyval($list,'id','name');
		S('SysRole',$data);
		return $data;
	}
	
}