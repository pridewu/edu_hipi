<?php
/**
 * 管理后台配置
 */
return array (
	
	'DEFAULT_THEME' 			=> 'v1',			//主题
	'LOG_IGNOIE_ACTIONS' 		=> array('index'),  //忽略日志操作列表
	
	'VAR_PAGE'					=> 'page',		//分页变量名
	'VAR_PAGESIZE'				=> 'rows',		//每页记录数变量名	
	'PAGE_SIZE'					=> '50',		//每页默认记录数
	
	//缓存项目列表
	'CACHE_LIST' => array(
		'SysRole'		=> '系统角色',
		'ProConfig'		=> '配置',
		'Channel'		=> '栏目',
		'Stage'			=> '龄段',
		'AdSpace'		=> '广告位',
		'Ad'			=> '广告',
	),		
	
	//上传附件支持的类型
	'UPFILE_FILE_TYPE'	=> array(
		1 => array('name'=>'image','exName'=>'bmp,jpg,jpeg,gif,png'),	//图片文件
		2 => array('name'=>'j2me','exName'=>'jar,jad'),					//j2me文件
		3 => array('name'=>'audio','exName'=>'mp3'),					//高清音频文件
		4 => array('name'=>'other','exName'=>'xls,xlsx'),				//其它文件
	),	
		
);