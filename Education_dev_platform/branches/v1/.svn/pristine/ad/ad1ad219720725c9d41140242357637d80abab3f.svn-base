<?php
/**
 * 逻辑处理类：配置
 * @author CGY
 *
 */
namespace Common\Logic;
class ProConfigLogic extends BaseLogic {
	
	/**
	 * 获取配置
	 * @param arr $param 查询参数(cKey)
	 * @return array 返回配置内容
	 */
	public function getConfig($cKey)
	{
		//先读缓存(缓存没有则会默认读数据库，并更新缓存)
		$confCache = get_pro_config_content($cKey);
		
		//读取模版文件,页面显示按模版配置来输出的，需要把最新的配置项更新到模版中。
		$configTpl = $this->getConfigTpl($cKey);
		if(!$configTpl['status']) return $configTpl;

		//不存在则读默认模版中的配置
		if(!empty($confCache))
		{
			foreach ($confCache as $k => $v){
				$configTpl['data'][$k]['value'] = $v;
			}
		}
		return $configTpl;
	}
	
	/**
	 * 更新/保存配置项内容
	 */
	public function updateConfig($data)
	{
		$record = D('ProConfig')->find($data['id']);
		if(empty($record)) return result_data(0,'配置记录不存在！');
		unset($data['id']);

		//解析页面传递的数据
		$record['content'] = $this->parsePageData($data,$record['templete']);
		//保存配置内容
		$rows = D('ProConfig')->saveData($record);
		
		return result_data(1,'配置更新成功！',array('rows'=>$rows));
	}
	
	/**
	 * 解析页面传递的数据(还原成配置中设置的格式在系列化)
	 * @param arr $data 页面传递的配置内容
	 * @param string $confTpl 配置模版文件名
	 */
	private function parsePageData($data,$confName){
		//获取模版文件
		$configTpl = $this->getConfigTpl($confName);
		if (!$configTpl['status']) return $configTpl;
		$configTpl = $configTpl['data'];

		//数据格式处理
		foreach ($data as $k => $v){
			switch ($configTpl[$k]['type']){
				case 'array': //数组类型
					$data[$k] = explode("\r\n",$v);
					foreach($data[$k] as $d){
						if(empty($d)) continue;
						$d = explode('=',$d);
						if(count($d)>1){
							$arr[trim($d[0])] = trim($d[1]);
						}else{
							$arr[] = trim($d[0]);
						}
					}
					$data[$k] = $arr;
					$arr = '';
					break;
				case 'textarea': //文本域类型
					$data[$k] = trim(str_replace("\r\n",'<br/>',$data[$k]));
					break;	
			}
		}
		return serialize($data);
	}
}