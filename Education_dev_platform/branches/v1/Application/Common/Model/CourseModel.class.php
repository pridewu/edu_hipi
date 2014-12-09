<?php
/**
 * 数据模型：课程
 * @author CGY
 *
 */
namespace Common\Model;
class CourseModel extends BaseModel {	
	
	//数据验证
	protected $_validate = array(
		array('id','require','id不能为空',self::MUST_VALIDATE,'',self::MODEL_UPDATE),
		array('name','require','课程名称不能为空！',self::MUST_VALIDATE,''),
		array('chId','require','顶级分类不能为空！',self::MUST_VALIDATE,''),
		array('typeId','require','课程类型不能为空！',self::MUST_VALIDATE,''),
		array('status',array(0,1),'请选择正确的状态！',self::MUST_VALIDATE,'in'),
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
	public function queryCourse($param='',$isTotal=true){
		$this->initSelectParam($param);
		$list['rows'] = $this->where($param['where'])->field($param['field'],$param['fieldExcept'])->order($param['sortOrder'])->page($param['page'],$param['pageSize'])->select();
		if($isTotal) $list['total'] = $this->where($param['where'])->count();
		
		//把栏目id,出版社id,类型,册数,科目id,标签,关键字id,龄段id,转换成名称在首页显示
		$channels = get_cache('Channel');
		$stages   = get_cache('Stage');
		$proConf  = get_pro_config_content('proConfig');
		foreach ($list['rows'] as $k=>$v){
			$list['rows'][$k]['chId']	 = $channels[$v['chId']]['name'];
			$list['rows'][$k]['pressId'] = $proConf['press'][$v['pressId']];
			$list['rows'][$k]['typeId']  = $proConf['courseType'][$v['typeId']];
			$list['rows'][$k]['session']  = $proConf['session'][$v['session']];
			$list['rows'][$k]['subject'] = $proConf['subject'][$v['subject']];
			
			$keys = explode(',', $v['keys']);
			$keys = array_filter($keys);
			if(count($keys)>0){
				foreach ($keys as $k1=>$v1){
					$_keys .= $proConf['keys'][$v1].',';
				}
				$list['rows'][$k]['keys'] = $_keys;
				unset($_keys);
			}
			unset($keys);
			
			$s = explode(',', $v['stage']);
			$s = array_filter($s);
			if(count($s)>0){
				foreach ($s as $k2=>$v2){
					$_stages .= $stages[$v2]['name'].',';
				}
				$list['rows'][$k]['stage']	= $_stages;
				unset($_stages);
			}
			unset($s);
		}
		return $this->returnListData($list);
	}
	
	/**
	 * 处理筛选条件
	 * 1.处理空值
	 * 2.关键字匹配
	 */
	protected function initWhere($where){
		//处理空值
		foreach ($where as $k=>$v){
			if($v == '') unset($where[$k]);
		}
		//关键字匹配
		$where['_string'] .= '(`keys` like "%'.$where['keys'].'%")';
		unset($where['keys']);
		
		return $where;
	}
}