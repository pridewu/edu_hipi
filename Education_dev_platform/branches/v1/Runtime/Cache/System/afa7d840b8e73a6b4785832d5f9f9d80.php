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


<div data-options="region:'center',split:true,border:false" style="overflow: hidden;">

	<div id="datagrid_menu" class="easyui-menu" style="width:120px;display: none;">
		<div onclick="add();" data-options="iconCls:'icon-add'" <?php echo ($buttonStyle['add']); ?>>新增</div>
		<div onclick="edit();" data-options="iconCls:'icon-edit'" <?php echo ($buttonStyle['edit']); ?>>编辑</div>
		<div onclick="del()" data-options="iconCls:'icon-remove'" <?php echo ($buttonStyle['del']); ?>>删除</div>
		
	<div onclick="config();" data-options="iconCls:'icon-edit'" <?php echo ($buttonStyle['config']); ?>>配置</div>
	<div onclick="reloadConf();" data-options="iconCls:'icon-edit'" <?php echo ($buttonStyle['configTpl']); ?>>重载配置模板</div>
    <!--<div onclick="configArea();" data-options="iconCls:'icon-edit'" <?php echo ($buttonStyle['configArea']); ?>>重载产品配置</div>-->
	<div onclick="sync();" data-options="iconCls:'icon-edit'" <?php echo ($buttonStyle['Sync']); ?>>手动数据同步</div>

	</div>
    
	<div id="datagrid_toolbar" style="padding:5px;">
	   <div style="float: left;">
	        <form method="post" id="search_form" style="padding: 0px;" onsubmit="search(datagrid,'#search_form');return false;">
	        	
	        				 
				<a href="javascript:search(datagrid,'#search_form');" class="easyui-linkbutton" iconCls="icon-search" plain="true" >查 询</a>
			</form>
		</div>
		<div align="right">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="add()" <?php echo ($buttonStyle['add']); ?>>新增</a>
			<span class="toolbar-btn-separator"></span>
			<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()" <?php echo ($buttonStyle['edit']); ?>>编辑</a>
			<span class="toolbar-btn-separator"></span>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="del()" <?php echo ($buttonStyle['del']); ?>>删除</a>			
			
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="config()" <?php echo ($buttonStyle['config']); ?>>配置</a>

			<a href="#" ></a>
		</div>
	</div>
	<table id="datagrid" toolbar="#datagrid_toolbar" border="false"></table>	
</div>



<script>
var edit_W = 600;
var edit_H = 500;
var datagrid;

$(function(){
	//数据列表
	datagrid = $("#datagrid").datagrid({
		url: '/System/ProConfig/index',
		fit: true,
		autoRowHeight: false, //自动行高
		border:false,
		pagination:true, //分页栏
		pagePosition:'bottom', //分页栏位置
		rownumbers:true,//显示行数
	    striped:true,//显示条纹
	    showFooter:true, //显示统计行
	    pageSize:<?php echo ($pageSize); ?>,//每页记录数
        remoteSort:true,//是否通过远程服务器对数据排序
        singleSelect:true,//只允许选择单行
        	
	idField : 'id',
	columns:[[ 
	    {field:'id',title:'ID',sortable:true,align:'right',width:60},
	    {field:'name',title:'名称',sortable:true,width:100},
	    {field:'cKey',title:'配置KEY',sortable:true,width:130},
	    {field:'templete',title:'配置文件',sortable:true,width:130},
	    {field:'content',title:'内容',sortable:true,width:300},
	    {field:'addTime',title:'添加时间',sortable:true,width:180},
	]],
	    
        onLoadSuccess:function(data){
	    	$(this).datagrid('clearSelections');//取消所有的已选择项
	    	$(this).datagrid('unselectAll');//取消全选按钮为全选状态
		},
	    onRowContextMenu : function(e, rowIndex, rowData) {
			e.preventDefault();
			$(this).datagrid('unselectAll');
			$(this).datagrid('selectRow', rowIndex);
			$('#datagrid_menu').menu('show', {
				left : e.pageX,
				top : e.pageY
			});
		},
        onDblClickRow:function(rowIndex, rowData){
            edit(rowIndex, rowData);
        },       
		
	});

});

function add(){
	addData("添加","#edit_form",datagrid,"/System/ProConfig/add",edit_W,edit_H);
}
function edit(rowIndex,rowData){
	editData(rowIndex,rowData,"编辑",'#edit_form',datagrid,"/System/ProConfig/edit",edit_W,edit_H);
}
function del(){
	delData(datagrid,"/System/ProConfig/del");
}




edit_W = 600;
edit_H = 500;

function reloadConf(){
	postData("/System/ProConfig/reloadConf",true,"",datagrid,"one");
}

function config(rowIndex,rowData){
	editData(rowIndex,rowData,"配置信息",'#edit_form',datagrid,"<?php echo U('ProConfig/config');?>",edit_W,edit_H);
}
	
function sync(){
	postData("/System/ProConfig/sync",true,"",datagrid,"one");
}	


</script>
</body>

	
</body>
</html>