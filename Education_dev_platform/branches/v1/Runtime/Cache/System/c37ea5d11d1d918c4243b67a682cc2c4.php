<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EDGE;chrome=1" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Cache-Control" content="no-store" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title>掌世界嗨皮课堂管理系统</title>

<link rel="stylesheet" type="text/css" href="/static/v1/system/themes/bootstrap/easyui.css" id="easyuiTheme">
<link rel="stylesheet" type="text/css" href="/static/v1/system/themes/icon.css">
<link rel="stylesheet" type="text/css" href="/static/v1/system/main.css">
<script type="text/javascript" src="/static/v1/system/js/lib/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/static/v1/system/js/lib/jquery-extend.js"></script>
<script type="text/javascript" src="/static/v1/system/js/lib/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/static/v1/system/js/lib/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/static/v1/system/js/main.js"></script>

</head>
<body class="easyui-layout panel-noscroll" style="width: 100%; height: 100%; overflow-y: hidden;" onselectstart="return false">


<div data-options="region:'center',split:true" style="overflow: hidden;">
	
	<noscript>您的浏览器暂不支持脚本功能，请开启脚本支持</noscript>
	<div style="font-size:30px;letter-spacing:20px; padding:80px; text-align:center">掌世界嗨皮课堂管理系统</div>
	<div id="win" class="easyui-window" title="用户登录" style="width:320px;height:240px"  
	       data-options="collapsible:false,minimizable:false,maximizable:false,closable:false,resizable:false">  
	    <form id="fLogin" method="post" style="padding:20px 35px;">  
		    <div>  
		        <label for="userName">用户名：</label>  
		        <input type="text" name="userName"  style="width:150px;" />  
		    </div> 
		    <br/>
		    <div>  
		        <label for="password">密　码：</label>  
		        <input type="password" name="password" style="width:150px;" />  
		    </div>		   
		    <div id="info" style="color:red;text-align:center; padding:10px 0px;">&nbsp;</div>
		    <div>
		    	<label>　　　　</label>
		    	<input id="btnLogin" type="submit" value="登录" style="padding:5px 15px"/>		    
		    </div>
		</form>   
	</div>
</div>
<script>
$('#fLogin').form({
	url:"<?php echo U('Public/login?ajax=true');?>",
    onSubmit: function(){   
        // do some check   
        // return false to prevent submit;   
    },   
    success:function(data){
     	var data = eval('(' + data + ')');
    	if(data.status){
    		top.location=data.url;
    	}else{
    		$("#info").html(data.info);
    	}  
    }   
}); 
</script>
	
</body>
</html>