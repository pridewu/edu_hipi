<?php

/**
 * 测试
 * @author Administrator
 *
 */

namespace Test\Controller;

class IndexController extends \Think\Controller {
	
	public function indexAct(){
		//$data['where'] = array('cKey'=>'p*confi');
		//$record = D('ProConfig')->selectOne($data);
		//$config = D('ProConfig','Logic')->getConfig('p*config');
		//$c = get_cache('ProConfig_p*config');
		
		/* 龄段,顶级分类测试
		$topChannel = S('Channel_top');
		$topChannel = get_array_for_fieldval($topChannel, 'chKey','allcourse');
		$topChannel = array_slice($topChannel,0,count($topChannel));
		$class = S('Channel_'.$topChannel[0]['id']);
		dump($class);  */
		
		/* $list = D('Stage')->selectPage();
		$list = array_values($list['rows']);
		foreach ($list as $k => $v){
			$list[$k]['chId'] = $class[$list[$k]['chId']]['name'];
		}
		dump($list); */
		
		//dump(S('Stage_20'));
		
		//exit;
		$this->display();
	}
}