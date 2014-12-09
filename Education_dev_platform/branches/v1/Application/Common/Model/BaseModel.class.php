<?php

/**
 * 数据模型基类
 * @author CGY
 *
 */
namespace Common\Model;
class BaseModel extends \Think\Model {
	
	protected $sortOrder = 'id asc'; //排序
	protected $sync		 = '';		 //数据同步(子项)
	
	
	/**
	 * 更改表名
	 * @param $name string	表名
	 * @return CommonModel
	 */
	public function setTableName($name) {
		$this->trueTableName = $name;
		return $this;
	}
	
	
	/**
	 * 获取一条数据
	 * @param arr $param
	 */
	public function selectOne($where = array(),$field = '',$fieldExcept = false){
        if(!$where) return;
		$data = array();
        $data = $this->where($where)->field($field,$fieldExcept)->limit(1)->find();
        //echo $this->getLastSql();
        return $data;
	}
	
	/**
	 * 按页读取数据
	 * @param array $param 选择参数 格式:请参考initSelectParam方法;
	 * @param bool $isTotal 是否返回总记录数
	 */
	public function selectPage($param='',$isTotal=true){
		$this->initSelectParam($param);
        if($param['initPage'] === true){
            $list['rows'] = $this->where($param['where'])->field($param['field'],$param['fieldExcept'])->order($param['sortOrder'])->select();        
        }else{
            $list['rows'] = $this->where($param['where'])->field($param['field'],$param['fieldExcept'])->order($param['sortOrder'])->page($param['page'],$param['pageSize'])->select();        
        }
 		save_log('execute_sql',array('sql'=>$this->getLastSql()));
        if($isTotal) $list['total'] = $this->where($param['where'])->count();
		return $this->returnListData($list);
	}
	
	
	/**
	 * 保存数据
	 * @param array $data
	 */
	public function saveData($data){
		if($this->create($data)){
			if(!$data['id']){
				$id = $this->add();
				$result = result_data(1,'数据添加成功！',array('id'=>$id));
			}else{
				$id = $this->save();
				$result = result_data(1,'数据更新成功！',array('rows'=>$id));
			}
			if($id>0){
				if(method_exists($this, 'updateCache')) $this->updateCache();
				if(!empty($this->sync)) $this->syncSend($this->sync);			}
			return $result;
		}else{
			return result_data(0,$this->getError());
		}
	}
	
	
	/**
	 * 删除数据
	 * @param int|array $id
	 */
	public function delData($id){
		if(!$id) return result_data(0,'没有数据被删除！');
		if(is_array($id)) $id=$id[0]; //$id = implode ($id,',');
		
		$num = $this->delete($id);
		if($num===false){
			return result_data(0,'数据删除失败：'.$this->getError(),$num);
		}else{
			if($num>0){
				if(method_exists($this, 'updateCache')) $this->updateCache();
				if(!empty($this->sync)) $this->syncSend($this->sync);
			}
			return result_data(1,'数据记录('.$num.'条)删除成功！',$num);
		}
	}
	
	
	
	/**
	 * 处理筛选条件
	 */
	protected function initWhere($where){
		//处理空值
		foreach ($where as $k=>$v){
			if($v == '') unset($where[$k]);
		}
		return $where;
	}
	
	
	/**
	 * 处理返回的空数据列表
	 * @param unknown_type $list
	 */
	protected function returnListData($list = '') {
		if (! isset($list ['rows']) || ! is_array($list ['rows']) || empty($list['rows'])) {
			return array ('rows' => array (), 'total' => 0);
		} else {
			return $list;
		}
	}
	
	
	/**
	 * 批量处理统计字段数据
	 * @param unknown_type $data
	 */
	protected function getIncOrDecData($data){
		foreach($data as $key=>$val){
			$data[$key]=array('exp',$key.'+('.$val.')');
		}
		return $data;
	}
	
	
	/**
	 * 初始化分页筛选参数
	 * @param array $param
	 * array(
	 		'where'=>'条件',
	 		'isLogic'=>'是否对where进行逻辑处理自定义规则(0|1)，默认0',
	 		如果为false,则不进行任何逻辑处理，直接将where传入下层ThinkPHP进行操作，此方式where参数必须符合ThinkPHP的条件规则,,
	 		如果为true,则调用initWhere方法对where参数进行逻辑处理
	 		'field'=>'字段列表',
	 		'fieldExcept'=>'是否字段排除(true|false),默认flase',
	 		'sortOrder'=>'排序',
	 		'page'=>'页码',
	 		'pageSize'=>'每页记录数'
	 		）
	 */
	protected  function initSelectParam(&$param){				
		if($param['isLogic']!=1 ){
			$param['where'] = $this->initWhere($param['where']);
		}
		//字段
		if($param['fieldExcept']!==true) $param['fieldExcept'] = false;
		//排序		
		if(!$param['sortOrder']){
			$sort = I('sort');
			if($sort) {
				$param['sortOrder'] = $sort . ' '. I('order');
			}else{
				$param['sortOrder'] = $this->sortOrder;
			}
		}
				
		//页码
        if($param['initPage'] !== true){
            list($param['page'],$param['pageSize']) = $this->getPageNum($param['page'],$param['pageSize']);
        }	
	}
	
	
	/**
	 * 初始化页码
	 * @param int $page
	 * @param int $pageSize
	 */
	protected function getPageNum($page=0,$pageSize=0){
		$page = $page ? $page : I(C('VAR_PAGE'),0);
		$page = $page ? $page : 1;
		$pageSize = $pageSize ? $pageSize : I(C('VAR_PAGESIZE'));
		$pageSize = $pageSize ? $pageSize : C('PAGE_SIZE');		
		return array($page,$pageSize);
	}
	
	
	/**
	 * 向子产品同步数据
	 * @param str $name //同步数据项名
	 */
	protected  function syncSend($name){
		return D('Sync','Logic')->send($name); //同步数据
	}
	
	
}