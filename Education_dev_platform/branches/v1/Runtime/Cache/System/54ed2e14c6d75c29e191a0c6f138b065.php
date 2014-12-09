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

<noscript>您的浏览器暂不支持脚本功能，请开启脚本支持</noscript>
<!-- 头部 -->
<div data-options="region:'north',border:false" style="height:60px;background:#eee;padding:6px">
	<div style="float:left; font-size:32px;">掌世界嗨皮课堂</div>
	<div style="float:right;  margin-right:10px;">
		<div style="text-align:right;margin-bottom:5px;">您好，<?php echo ($currUser['name']); ?> [<?php echo ($currUser['roleName']); ?>]欢迎您！</div>
		<!-- <a href="javascript:;" class="easyui-menubutton" data-options="menu:'#menu_skin'">更换皮肤</a> -->    
		<a href="javascript:;" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-edit'" onclick="editPwd()">修改密码</a>
		<a href="<?php echo U('Public/logout');?>" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-back'">注销退出</a>
	</div>
</div>
<!-- 导航菜单 -->
<div data-options="region:'west',split:true,title:'导航菜单'" style="width:200px;">
	<div class="easyui-accordion" data-options="fit:true,border:false" style="overflow-y:scroll">	
	<ul id="nav" class="easyui-tree" style="padding:10px;">	
	<?php if(is_array($nav)): foreach($nav as $key=>$n1): ?><!-- 分类导航 -->
		<li><span><?php echo ($n1["name"]); ?></span>
			<ul>
			<?php if(is_array($n1["item"])): foreach($n1["item"] as $k2=>$n2): ?><!-- 子菜单 -->
				<?php $src = empty($n2['src']) ? $k2.'/index' : $n2['src']; ?>						
				<li id="<?php echo U($src);?>"><?php echo ($n2["name"]); ?></li><?php endforeach; endif; ?>
			</ul>
		</li><?php endforeach; endif; ?> 
	</ul>
	</div>
</div>
<!-- 版权信息 -->	
<div data-options="region:'south',border:false" style="height:30px;background:#eee;padding:5px; text-align:center;">版权所有 (&copy) 掌世界科技</div>
<!-- 主区域 -->
<div data-options="region:'center'">
	<div id="mt" class="easyui-tabs" data-options="fit:true,border:false">  
   		<div title="首页" style="padding:20px;font-size:18px"><?php echo ($html); ?></div>
	</div>
</div>

<script>
$(function(){
	//处理导航菜单
	$("#nav").tree({
		lines: true,
		onClick: function(node){
			if($("#nav").tree('getChildren',node.target)!=''){
				if(node.state=='open'){
					$("#nav").tree('collapse',node.target);
				}else{
					$("#nav").tree('expand',node.target);					
				}
				return;
			}
			if(node.text=="更新缓存"){
				editDialog('更新缓存','#edit_form',null,"<?php echo U('Cache/update');?>",300,150);
				return;
			}
            if(node.text=="导入数据"){
				editDialog('导入数据','#import_form',null,"<?php echo U('Import/index');?>",600,300);
				return;
			}
			if($("#mt").tabs('exists',node.text)){
				$("#mt").tabs('select',node.text);
			}else{			
				$('#mt').tabs('add',{
				    title: node.text,
				    content:'<iframe src="'+ node.id +'" frameborder="no" width="100%" height="100%" />',
				    closable:true,
				    style: 'padding:20px;',
				});
			}
		}
	});
	
	$("#proId").combobox({
		onSelect:function(param){
            if(param.value == '') {
                param.value = '<?php echo ($proId); ?>';
            }
			location.href= "/System/Index?proId=" + param.value;
		}
   	});
});
function editPwd(){
	editDialog('修改密码','#pwd_form',null,"/System/Index/editpwd",300,220);
}






</script>	
</body>
</html>