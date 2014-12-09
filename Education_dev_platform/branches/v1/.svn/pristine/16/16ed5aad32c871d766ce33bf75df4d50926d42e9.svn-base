<?php

/**
 * 当前项目通用函数库
 */

/**
 * 读取配置
 * @param string $key 配置key
 * @return arr
 */
function CP($key){
	$conf = D('ProConfig')->getConfig($key);
	return $conf;
}


/**
 * 获取配置中的配置内容content
 * @param string $cKey 配置key
 */
function get_pro_config_content($cKey){
	$conf = get_cache('ProConfig');
	$conf = $conf[$cKey];
	$content = $conf['content'];
	return unserialize($content);
}