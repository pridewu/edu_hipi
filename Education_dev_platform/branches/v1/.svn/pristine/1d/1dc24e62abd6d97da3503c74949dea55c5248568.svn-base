<?php

/**
 * 数据模型：系统用户
 * @author CGY
 *
 */
namespace Common\Model;
class SysUserModel extends BaseModel{
	
	
	//数据验证
	protected $_validate = array(			
		//用户名
		array('name','require','用户名称不能为空！',self::EXISTS_VALIDATE,''),
		array('name','','用户名称已存在！',self::EXISTS_VALIDATE,'unique'),
		//用户组
		array('roleId','integer','请选择所属角色！',self::EXISTS_VALIDATE),
		//密码
		array('password','require','密码不能不空！',self::EXISTS_VALIDATE),		
	);
	
	//自动填充	
	protected $_auto = array(
		array('addTime',DATE_TIME,self::MODEL_INSERT),
		array('status',1,self::MODEL_INSERT),
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
			$param['field']='password';
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
		if($condition['roleId']>0) $where['roleId'] = $condition['roleId'];
		if(is_numeric($condition['id'])){
			$where['id'] = $condition['id'];
		}elseif(is_array($condition['id'])){
			$where['id'] = array('in',implode(',',$condition['id']));
		}elseif(!empty($condition['id']) && is_string($condition['id'])){
			$where['name'] = $condition['id'];
		}
		return $where;
	}
	
		
	/**
	 * 根据ID读取条数据
	 * @param unknown_type $id
	 */
	public function selectOne($id){
		$where['ru.id'] = $id;
		$field = 'ru.id,ru.name,ru.realName,ru.roleId,ru.status,ru.lastTime,ru.lastIp,r.name as roleName,r.isSuper,r.auth';
		return $this->alias('ru')->where($where)->field($field)->join('__SYS_ROLE__ r ON r.id=ru.roleId')->find();
	}
	
	/**
	 * 保存数据
	 * @param array $data
	 */
	public function saveData($data){
		$data = get_array_data($data,'name,status,password,roleId','id,realName');
		if(!empty($data['password'])) {
			$data['password'] = md5($data['password']);
		}else{
			if(!empty($data['id'])) unset($data['password']); //编辑时无设置新密码时取消更新此项
		}		
		if($this->create($data)){
			if(empty($data['id'])){
				$id = $this->add();
			}else{
				$id = $this->save();
			}
			return result_data(1,'数据保存成功！',array('id'=>$id));
		}else{
			return result_data(0,$this->getError());
		}
	}
	
		
	/**
	 * 用户登录
	 * @param string $name		用户名
	 * @param string $password	用户密码
	 * @param string $lastIp 	登录IP
	 */
	public function login($name,$password,$lastIp=''){
		if(empty($lastIp)) $lastIp = get_client_ip();
		$data = $this->field('id,lastTime,lastIp')->where(array('name'=>$name,'password'=>md5($password),'status'=>1))->find();
		if($data){
			$this->data(array('id'=>$data['id'],'lastTime'=>DATE_TIME,'lastIp'=>$lastIp))->save();
		}
		return $data;
	}
	
	/**
	 * 修改密码
	 * @param string $oldPassword
	 * @param string $password
	 * @param string $rePassword
	 */
	public function editpwd($id,$oldPassword,$password,$rePassword){
		if(empty($oldPassword)) return result_data(0,'请输入旧密码！');
		if(empty($password)) return result_data(0,'请输入新密码！');
		if($password != $rePassword) return result_data(0,'两次输入的密码不一致！');
		$user = $this->field('id,password')->find($id);
		if(!$user) return result_data(0,'发生未知的错误！');
		if($user['password'] != md5($oldPassword)) return result_data(0,'您输入的旧密码错误！');
		$this->data(array('id' => $id,'password' => md5($password)))->save();
		return result_data(1,'密码修改成功！');
	}
	
		
}