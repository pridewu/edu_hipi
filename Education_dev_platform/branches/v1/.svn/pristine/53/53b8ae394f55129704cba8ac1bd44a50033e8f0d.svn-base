<?php
namespace Common\Behaviors;
use Think\Behavior;

class AppBeginBehavior extends Behavior{
	
	public function run(&$param){
		if(defined('APP_INITED')) return;
		//格式化的时间
		defined('DATA_TIME') or define ('DATE_TIME',date('Y-m-d H:i:s',NOW_TIME));
		
		//完全地址
		defined('HTTP_REFERER') or define('HTTP_REFERER',$_SERVER['HTTP_REFERER']); //前一页
		defined('HTTP_SELF') or define('HTTP_SELF','http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); //当前页
		defined('HTTP_SELF_URLENCODE') or define('HTTP_SELF_URLENCODE', urlencode(str_replace('/', '@', $_SERVER['REDIRECT_URL'])));//当前地址处理		
			
		
		//更换主题模板路径		
		C('TMPL_PARSE_STRING.__THEME__',C('TMPL_PARSE_STRING.__THEME__').'/'.strtolower(MODULE_NAME));
		define('APP_INITED',true);
	}
}
?>