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
    
    <div id="datagrid_img" class="datagrid_img" style="display: none;">
        
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
			
    <a href="#" class="easyui-linkbutton" iconCls="icon-sum" plain="true" <?php echo ($buttonStyle['export']); ?> onclick="return exportData();">导出数据</a>

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
		url: '/System/Channel/index',
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
        
		pagination:false, //分页栏 
		idField : 'id',
	    columns:[[ 
            {field:'id',title:'ID',sortable:false,align:'right',width:60},
            {field:'name',title:'栏目名称',sortable:false,width:200,
            	formatter:function(value,row,index){
            			return (new Array(parseInt(row.level)+1).join("　　")) + value;
            		}
            	},
            {field:'chKey',title:'栏目KEY',sortable:false,width:100},
			{field:'imgUrl',title:'图片路径',sortable:false,width:250},
			{field:'linkUrl',title:'跳转地址',sortable:false,width:150},                        
			{field:'isShow',title:'在首页导航中',sortable:true,width:100,
				formatter:function(value,row,index){
						return value==1 ? "显示" : "<font color=red>不显示</font>";
					}
				},                      
            {field:'description',title:'栏目描述',sortable:false,width:150},  
            {field:'level',title:'层级',sortable:false,width:60},
            {field:'path',title:'路径',sortable:false,width:100},
            {field:'childIds',title:'子节点串',sortable:false,width:180},           
            {field:'sort',title:'排序',sortable:true,width:80},
            {field:'status',title:'状态',sortable:true,width:60,
            	formatter:function(value,row,index){
            			return value==1 ? "启用" : "<font color=red>禁用</font>";
            		}
            	},            
            {field:'addTime',title:'添加时间',sortable:true,width:180},
        ]],
        onMouseOverRow:function(e, rowIndex, rowData,field,value){
            
            if((field == 'imgUrl') && value != ''){
               
               var fieldValue = eval("rowData.realNavImgUrl");
               var imgArr = fieldValue.split(",");
               var imgStr = '';
               //alert(imgArr.length);
               if(imgArr.length>1){
                    for(var i=0;i<(imgArr.length);i++){
                         imgStr += '<p><img src="'+imgArr[i]+'" /></p>';
                    }
               }else{
                    imgStr = '<p><img src="'+fieldValue+'" /></p>';
               }
               //alert(imgStr);
               $("#datagrid_img").html(imgStr);
               $("#datagrid_img").show();
               if($("#datagrid_img").height()+e.pageY > $(document).height()){
                    e.pageY = e.pageY-$("#datagrid_img").height();
               }
               //alert($(document).height());
               $("#datagrid_img").css("left",e.pageX).css("top",e.pageY);
            }
       },  
       onMouseOutRow:function(e,rowIndex, rowData){  
           $("#datagrid_img").hide();
       }, 
	    
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
	addData("添加","#edit_form",datagrid,"/System/Channel/add",edit_W,edit_H);
}
function edit(rowIndex,rowData){
	editData(rowIndex,rowData,"编辑",'#edit_form',datagrid,"/System/Channel/edit",edit_W,edit_H);
}
function del(){
	delData(datagrid,"/System/Channel/del");
}




function exportData(){
    window.location="/System/Channel/exportData";
}


</script>
</body>

	
</body>
</html>