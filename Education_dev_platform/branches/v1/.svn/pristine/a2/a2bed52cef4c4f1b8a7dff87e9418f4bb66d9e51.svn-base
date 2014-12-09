<?php

/**
 * 接口调用控制器基类
 * @author CGY
 *
 */

namespace Api\Controller; 
use Think\Controller\HproseController;

class BaseApiController extends HproseController{
	
	/* 接口调用描述信息 */
	public $_SUCCESS 		= 1;		//接口调用成功
	public $_ERROR_USERID 	= -1001;	//userId为空或有误
	
	
	public function getMsg($code){
		switch ($code){
			case 1:
				return "接口调用成功！";
			case -1001:
				return "userId为空或有误!";
		}
	}
}