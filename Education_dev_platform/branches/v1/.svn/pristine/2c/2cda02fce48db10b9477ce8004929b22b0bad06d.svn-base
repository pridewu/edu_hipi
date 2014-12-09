<?php

/**
 * 业务相关通用函数库
 */

/**
 * 获取缓存
 * @param string $key
 */
function get_cache($name) {
	$data = S($name);
	if (empty($data)) {
		$data = D($name)->updateCache();
	}
	return $data;
}

/**
 * 获取附件文件URL
 * @param string $url
 * @param string $suffix
 * @param string $path
 */
function get_upfile_url($url, $suffix = '', $path = '') {
	if (empty($url))
		return;
	if (!empty($suffix)) {
		$info = pathInfo($url);
		$url = $info['dirname'] . '/' . $info['filename'] . '_' . $suffix . '.' . $info['extension'];
	}
	$tmpl = C('TMPL_PARSE_STRING');
	if (is_int($path)) {
		$path = $tmpl['__ALBUM'.$path.'__'];
	} elseif (empty($path)) {		
		$search = array('__COMMON__','__SD__','__HD__','__THEME__');
		$replace = array($tmpl['__COMMON__'],$tmpl['__SD__'],$tmpl['__HD__'],$tmpl['__THEME__']);
		foreach(C('ALBUM_TYPE') as $key=>$v){
			$search[] = 'album'.$key;
			$replace[] = 'album'.$tmpl[$key];
		}
		$url = str_replace($search, $replace, $url);
		if (substr($url, 0, 1) == '/' || substr($url, 0, 2) == './' || substr($url, 0, 3) == '../' || substr($url, 0, 7) == 'http://' || substr($url, 0, 8) == 'https://' || substr($url, 0, 6) == 'ftp://') {
			return $url;
		} else {
			$path = $tmpl['__UPFILE__'];
		}
	}
	if (substr($path, -1) != '/')
		$path .= '/';
	return $path . $url;
}

/**
 * 保存日志
 * @param string $type	日志类型：login|pv|credit|playvideo|error|dock
 * @param array $data	日志数据
 * @param array $debugLog 是否调试日志，如果为1，则只在DEBUG_LOG配制设置为1的才会写日志
 * @param int $time	 是否按照日期格式保存
 * @return void|string
 */
function save_log($type, $data = array(), $debugLog=0,$isTime=1) {	
	if(!C('DEBUG_LOG') && $debugLog) return;
    if (empty($type))  return;
    if (!is_array($data))  return;
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $data[$key] = json_encode($value);
        }
    }
    $data = implode("\t", $data) . "\r\n";
    
    if($debugLog) $isTime=0;
    
    if($isTime){
        $fileName = $type . '_' . date('Ymd') . '.log';
        $savePath = C('LOG_SAVEPATH') . '/'.$type.'/'. date('Y-m');
    }else{
        $fileName = $type . '.log';
        $savePath = C('LOG_SAVEPATH') . '/'.$type;
    }
    
    if (!is_dir(C('LOG_SAVEPATH'))) {
        if (!mkdir(C('LOG_SAVEPATH')))
            return C('LOG_SAVEPATH').'目录不存在';
    }
    if(!is_dir(C('LOG_SAVEPATH').'/'.$type)){
    	if(!mkdir(C('LOG_SAVEPATH').'/'.$type)){
    		return C('LOG_SAVEPATH').'/'.$type.'目录不存在';
    	}
    }
    if (!is_dir($savePath)) {
        if (!mkdir($savePath))
            return $savePath.'目录不存在';
    }else {
        if (!is_writeable($savePath))
            return $savePath.'目录不可写';
    }
    $fileName = $savePath . '/' . $fileName;
    //检测日志文件大小，超过配置大小则备份日志文件重新生成
    if (is_file($fileName) && floor(C('LOG_FILE_SIZE')) <= filesize($fileName))
        rename($fileName, $savePath . '/' . basename($fileName, '.log') . '.' . time() . '.log');

    return error_log($data, 3, $fileName);
}


/**
 * 对数组进行分页
 * @param array $data
 * @param int $pageSize 
 * @param unknown_type $config
 * @param unknown_type $parameter
 * @return multitype:multitype: Ambigous <NULL, number>
 */
function get_array_page($data, $pageSize, $imgPath = '', $config = array(), $parameter = '') {
    $page = get_pageHtml(count($data), $pageSize,$config, $imgPath);
    $data = array_slice($data, $page['firstRow'], $pageSize, true);
    return array('data' => $data, 'pageHtml' => $page['html']);
}

/**
 * 生成分页页码
 * @param int $count	总记录数
 * @param int $pageSize 每页记录数
 * @param array $config	配制参数 
 * @param string $parameter 其它连接参数
 */
function get_pageHtml($count, $pageSize, $config = array(), $imgPath = '', $parameter = '',$url='') {
    if (empty($imgPath) || strlen($imgPath)==1) {
        if(strlen($imgPath)==1) $fix = $imgPath.'_';
        $imgPath = C('TMPL_PARSE_STRING.__' . strtoupper(C('PARENT_MODULE') . '__')) . '/images';
    }else if(!strstr($imgPath,'/')){
        $imgPath = C('TMPL_PARSE_STRING.__' . strtoupper(C('PARENT_MODULE') . '__')) . '/images/'.$imgPath;
    }else{
        $fix = '';
    }
    
    $dfConfig = array(
        'prev' => array($imgPath . '/'.$fix.'page_prev.png', $imgPath . '/'.$fix.'page_prev_over.png'),
        'next' => array($imgPath . '/'.$fix.'page_next.png', $imgPath . '/'.$fix.'page_next_over.png'),
        'theme' => '<table align="center" class="page"><tr><td class="up">%UP_PAGE%</td><td class="now">%NOW_PAGE%/%TOTAL_PAGE%</td><td class="down">%DOWN_PAGE%</td></tr></table>',
    );

    $config = array_merge($dfConfig, $config);
    $Page = new \Think\Page($count, $pageSize);
    foreach ($config as $key => $cnf) {
        $Page->setConfig($key, $cnf);
    };
    $Page->parameter = $parameter;
    $Page->url = $url;
    return array(
        'firstRow' => $Page->firstRow,
        'html' => $Page->show(),
    );
}


/**
 * 通过Post或get发送数据
 * @param unknown_type $url
 * @param unknown_type $data
 */
function url_data($url,$data,$type='post'){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url) ;
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	if($type=='get'){
		curl_setopt($ch, CURLOPT_HEADER, 0);
	}else{
		curl_setopt($ch, CURLOPT_POST,count($data)) ; // 启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data); // 在HTTP中的“POST”操作。如果要传送一个文件，需要一个@开头的文件名
	}
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}


/**
 * 添加浮动消息
 * @param string $message
 */
function add_float_message($message, $url = '') {
    $floatMessage = Session('floatMessage');
    if(!empty($message)){
        if(strpos($message, '@@') != false){
            $mesArr = explode('@@', $message);
            $floatMessage .= "<div class='float_message_div' style='font-size:24px;'>".str_replace('"', '\"', $mesArr[0]) . "</div>";
            $floatMessage .= "<div class='float_message_div' style='font-size:24px;'>".str_replace('"', '\"', $mesArr[1]) . "</div>";
        }else{
            $floatMessage .= "<div class='float_message_div' style='font-size:24px;'>".str_replace('"', '\"', $message) . "</div>";
        }
    }
    Session('floatMessage', $floatMessage);
    if (!empty($url)) {
        header('LOCATION:' . $url);
        exit;
    }
}