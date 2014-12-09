<?php

/**
 * 通用函数库
 */

/**
 * 返回统一格式的结果
 * @param bool $status	操作结果（true or false）
 * @param string $info  提示信息
 * @param mixed $data 	要返回的数据
 * @return array 		返回格式：array('status'=>[true|false],'info'=>string,'data'=>mixed)
 */
function result_data($status, $info = '', $data = '') {
    if (empty($info)) {
        $info = $status ? '操作成功!' : '操作失败';
    }
    return array('status' => $status, 'info' => $info, 'data' => $data);
}

/**
 * 从数据数组中根据必要及非必要条件取出所需子集
 * @param array $vals		原数组
 * @param string $require	必须项字段(不存在自动生成空值）,多字段用逗号分隔
 * @param string $optional	可选项字段(不存在不处理),多字段用逗号分隔
 * @return array 			必须项和可选项相加的数据子集
 */
function get_array_data($arr, $require, $optional = '') {
    $data = array();
    $require = explode(',', $require);
    $optional = explode(',', $optional);
    foreach ($require as $field) {
        $data [$field] = $arr [$field];
    }
    foreach ($optional as $field) {
        if (isset($arr [$field])) {
            $data [$field] = $arr [$field];
        }
    }
    return $data;
}

/**
 * 根据某个值获取数组的关键字（主要用于一维数组）或其它所属值（主要用于二维数组）
 * @param $arr array		原数组
 * @param $searchVal mixed	待查询的字段值
 * @param $searchKey string	待查询的字段KEY
 * @param $resultKey string 待返回结果的字段KEY
 * @return NULL / mixed		
 */
function get_array_keyval($arr, $searchVal, $searchKey = '', $resultKey = '') {
    foreach ($arr as $k => $v) {
        $v1 = empty($searchKey) ? $v : $v [$searchKey];
        if ($v1 == $searchVal) {
            return empty($resultKey) ? $k : $v [$resultKey];
        }
    }
    return null;
}

/**
 * 根据数组值获取键值(一维或是二维数组)
 * $val 数值值
 * return $keyItem 键值
 */
function get_array_key($val,$data=array(),$pos=0) {
	if(!is_array($data)){
		return;
	}
	$newArr = array();
	foreach ($data as $key => $value) {
		if(!is_array($value)){
			$newArr[$key] = $value;
		}else{
			$newArr[$key] = $value[$pos];
		}
	}
	$keyItem = array_search($val, $newArr);
	return $keyItem;
}

/**
 * 从数组中返回某个值（主要用于无法连续书写的语句上）
 * @param array $arr
 * @param string|int $key
 */
function get_array_val($arr, $key) {
    return $arr [$key];
}

/**
 * 从数组中返回某个列组成新数组
 * @param arr $arr
 * @param str $key 如果$key为空，则以key为值组成新数组
 */
function get_array_vals($arr, $searchKey) {
    foreach ($arr as $k => $v) {
        $newArr[$k] = $v[$searchKey];
    }
    return $newArr;
}

/**
 * 根据二维表数组某个字段值取回子集
 * @param unknown_type $arr 数组
 * @param unknown_type $field 字段名
 * @param unknown_type $val 字段值
 * @return unknown
 */
function get_array_for_fieldval($arr,$field,$fieldVal){	
	foreach($arr as $key => $val){		
		if($val[$field]!=$fieldVal) {
			unset($arr[$key]);
		}
	}
	return $arr;
}

/**
 * 从数组中取某列值替换数组的键名
 * @param unknown_type $arr
 * @param unknown_type $keyName 新KEY所有列的KEY
 * @param string $valName 值所有列的KEY
 * @return array
 */
function array_replace_keyval($arr, $keyName='',$valName='') {
    foreach ($arr as $key => $val) {
    	$k = empty($keyName) ? $k : $val[$keyName];
    	$v = empty($valName) ? $val : $val[$valName];
        $newArr[$k] = $v;
    }
    return $newArr;
}

/**
 * 根据条件，将一个数据的字段附加到另一个数组中(只要用于关联的两个二维表数组)
 * @param unknown_type $arr1
 * @param unknown_type $arr2
 * @param unknown_type $keys
 * @param unknown_type $fields
 */
function array_add_field($arr1,$arr2,$joinKey,$fields){
	$fields = explode(',',$fields);
	foreach($arr1 as $k1=>$v1){		
		foreach($fields as $fV){
			$v1[$fV] = $arr2[$v1[$joinKey]][$fV];
		}
	}
	return $arr1;
}

/**
 * 获取一定范围内的随机数字 位数不足补零
 * @param integer $min 最小值
 * @param integer $max 最大值
 * @return string
 */
function rand_number($min, $max) {
    return sprintf("%0" . strlen($max) . "d", mt_rand($min, $max));
}

/**
 * 判断除0外的空
 * @param unknown_type $val
 * @return boolean
 */
function is_empty_null($val){
	return ($val==='' || $val===null);
}

/**
 * 判断是否为json数据
 * @param unknown_type $string
 * @return boolean
 */
function is_json($string){
	json_decode($string); 
	return (json_last_error() == JSON_ERROR_NONE);
}
