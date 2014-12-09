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
		
	</div>
    
	<div id="datagrid_toolbar" style="padding:5px;">
	   <div style="float: left;">
	        <form method="post" id="search_form" style="padding: 0px;" onsubmit="search(datagrid,'#search_form');return false;">
	        	
	userId：<input type="text" name="where[userId]" placeholder="请输入用户ID" style="width: 80px" />	
	运营商用户Id：<input type="text" name="where[opUserId]" placeholder="" style="width: 80px" />	
	运营商用户名：<input type="text" name="where[opUserName]" placeholder="" style="width: 80px" />
	电话号码：<input type="text" name="where[phone]" placeholder="" style="width: 80px" />
    <br />开始时间：<input class="easyui-datebox" id="beginTime" name="beginTime" style="width:150px" />
    &nbsp;结束时间：<input class="easyui-datebox" id="endTime" name="endTime" style="width:150px" />
			 
				<a href="javascript:search(datagrid,'#search_form');" class="easyui-linkbutton" iconCls="icon-search" plain="true" >查 询</a>
			</form>
		</div>
		<div align="right">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="add()" <?php echo ($buttonStyle['add']); ?>>新增</a>
			<span class="toolbar-btn-separator"></span>
			<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()" <?php echo ($buttonStyle['edit']); ?>>编辑</a>
			<span class="toolbar-btn-separator"></span>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="del()" <?php echo ($buttonStyle['del']); ?>>删除</a>			
			
    <span style="display: inline-block;width:60px;height:50px;">
    <a href="#" class="easyui-linkbutton" iconCls="icon-sum" plain="true" onclick="count()" <?php echo ($buttonStyle['count']); ?>>汇总</a>
    </span>

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
		url: '/System/User/index',
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
        
	    //sortName:'id',//默认排序字段
		//sortOrder:'asc',//默认排序方式 'desc' 'asc'
		idField : 'userId',
	    columns:[[ 
            {field:'userId',title:'教育平台用户Id',sortable:true,align:'right',width:100},
            {field:'opUserId',title:'运营商用户Id',sortable:true,width:100},
            {field:'opUserName',title:'运营商用户名',sortable:true,width:100},
            {field:'opUserToken',title:'运营商提供的UserToken',sortable:true,width:150},
            {field:'nickName',title:'用户昵称',sortable:true,width:100},
            {field:'point',title:'用户积分',sortable:true,width:100},
            {field:'amount',title:'用户元宝',sortable:true,width:100},
            {field:'face',title:'用户头像',sortable:true,width:100},
            {field:'phone',title:'手机号码',sortable:true,width:100},
            {field:'qq',title:'QQ',sortable:true,width:100},
            {field:'address',title:'用户地址',sortable:true,width:150},
            {field:'email',title:'邮箱',sortable:true,width:120},
            <?php if(is_array($credits)): foreach($credits as $key=>$credit): ?>{ field:'<?php echo ($credit["cKey"]); ?>',title:'<?php echo ($credit["title"]); ?>',sortable:true,align:'right',width:80},<?php endforeach; endif; ?>
            {field:'addTime',title:'注册时间',sortable:true,width:150},
        ]],
	    
        onLoadSuccess:function(){
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
	addData("添加","#edit_form",datagrid,"/System/User/add",edit_W,edit_H);
}
function edit(rowIndex,rowData){
	editData(rowIndex,rowData,"编辑",'#edit_form',datagrid,"/System/User/edit",edit_W,edit_H);
}
function del(){
	delData(datagrid,"/System/User/del");
}




function edit(rowIndex,rowData){
	editData(rowIndex,rowData,"编辑",'#edit_form',datagrid,"/System/User/edit",600,520,'userId');
}
function count(){
    post("/System/User/count",true,null,$.serializeObject($('#search_form')));
}


</script>
</body>

	
</body>
</html>