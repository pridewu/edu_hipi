<?php

/**
 * THINKPHP项目配置(部署后请不要随意修改)
 */
return array (  
	'SHOW_PAGE_TRACE'	=>true,	
	'LOAD_EXT_CONFIG' 	=> 'area', 			// 加载扩展配置文件		
	'LOAD_EXT_FILE'		=> 'util,common', 	// 动态扩展函数库
	'ACTION_SUFFIX' 	=> 'Act', 			// 操作方法后缀
	'TMPL_FILE_DEPR' 	=> '/', 			// 模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符	
	'URL_MODEL' 		=> 2, 				// URL访问模式,可选参数0、1、2、3,代表以下四种模式：0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE 模式); 3 (兼容模式)  // 默认为PATHINFO 模式，提供最好的用户体验和SEO支持
	'URL_PATHINFO_DEPR' => '/', 			// PATHINFO模式下，各参数之间的分割符号			
	'SESSION_PREFIX'    => 'platform_',    	// Session前缀		
		
	//其它参数
	'VAR_PAGE'			=> 'page',			// 分页变量名
	'VAR_PAGESIZE' 		=> 'pageSize',		// 每页记录数变量名
	'PAGE_SIZE'			=> '10',			// 每页默认记录数
	
	//自定义参数	
	'LOG_SAVEPATH'		=>	'./logs',						// 日志存放路径 
	'SECRET_KEY'		=> 	'isdj&@#)#*dsid&#(idslNDiie*#', // 产品与后台通信密钥    
);