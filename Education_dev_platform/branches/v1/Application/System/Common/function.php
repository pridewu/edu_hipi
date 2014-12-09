<?php
/**
 * 数据加解密(从Discuz系统中提取)
 * @param $string string	 待加解密字段串
 * @param $operation string	操作类型：ENCODE ｜DECODE
 * @param $key string		密钥
 * @param $expiry int		有效期
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;
	$key = md5($key != '' ? $key : C('AUTH_KEY'));
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime ()), - $ckey_length)) : '';

	$cryptkey = $keya . md5($keya . $keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time () : 0) . substr(md5($string . $keyb), 0, 16) . $string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array ();
	for($i = 0; $i <= 255; $i ++) {
		$rndkey [$i] = ord($cryptkey [$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i ++) {
		$j = ($j + $box [$i] + $rndkey [$i]) % 256;
		$tmp = $box [$i];
		$box [$i] = $box [$j];
		$box [$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i ++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box [$a]) % 256;
		$tmp = $box [$a];
		$box [$a] = $box [$j];
		$box [$j] = $tmp;
		$result .= chr(ord($string [$i]) ^ ($box [($box [$a] + $box [$j]) % 256]));
	}

	if ($operation == 'DECODE') {
		if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time () > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc . str_replace('=', '', base64_encode($result));
	}
	
}	

function p($array)
{
	dump($array, 1, '<pre>', 0);
}

/**
 * 添加时间
 * @param $part string 	类型
 * @param $n int		数量
 * @param $date string	日期
 */
function get_date_add($part, $n, $date) {
	switch ($part) {
		case "y" :	$val = date("Y-m-d H:i:s", strtotime($date . " +$n year"));	 break;
		case "m" :	$val = date("Y-m-d H:i:s", strtotime($date . " +$n month")); break;
		case "w" :	$val = date("Y-m-d H:i:s", strtotime($date . " +$n week"));	 break;
		case "d" :	$val = date("Y-m-d H:i:s", strtotime($date . " +$n day")); 	break;
		case "h" :	$val = date("Y-m-d H:i:s", strtotime($date . " +$n hour"));	break;
		case "n" :	$val = date("Y-m-d H:i:s", strtotime($date . " +$n minute")); break;
		case "s" :	$val = date("Y-m-d H:i:s", strtotime($date . " +$n second")); break;
	}
	return $val;
}
	
/**
 * 获取一个月的最后一天
 *
 * @param $d string
 */
function get_month_last($date) {
	return get_date_add('d', - 1, date('Y-m-1', strtotime(get_date_add('m', 1, $date))));
}



/**
 * 获取权限结构
 */
function get_auth_structure($key=''){
	$auth =  require(MODULE_PATH . 'Conf/auth.php');
	
	if(empty($key)) {
		return $auth;
	}else{
		return $auth[$key];
	}
}

/**
 * 获取合作商
 * @param unknown_type $key
 */
function get_partner($key=''){
	$partner = require(MODULE_PATH.'Conf/partner.php');
	if(empty($key)){
		return $partner;
	}else{
		return $partner[$key];
	}
}



