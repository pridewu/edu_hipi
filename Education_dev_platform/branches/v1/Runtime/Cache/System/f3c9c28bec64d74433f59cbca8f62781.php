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
	        	
	ID：<input type="text" name="where[id]" placeholder="请输入ID或关键字" style="width: 80px" />
	资源商:<?php echo ($rpHtml); ?>
	状态：<?php echo ($statusHtml); ?>
			 
				<a href="javascript:search(datagrid,'#search_form');" class="easyui-linkbutton" iconCls="icon-search" plain="true" >查 询</a>
			</form>
		</div>
		<div align="right">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="add()" <?php echo ($buttonStyle['add']); ?>>新增</a>
			<span class="toolbar-btn-separator"></span>
			<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()" <?php echo ($buttonStyle['edit']); ?>>编辑</a>
			<span class="toolbar-btn-separator"></span>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="del()" <?php echo ($buttonStyle['del']); ?>>删除</a>			
			
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
		url: '/System/Resource/index',
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
        
	    //sortName:'sort',//默认排序字段
		//sortOrder:'asc',//默认排序方式 'desc' 'asc'
		idField : 'id',
	    columns:[[  
            {field:'id',title:'ID',sortable:false,align:'right',width:60},
            {field:'title',title:'视频标题',sortable:false,width:70},
            {field:'sectionId',title:'课时ID',sortable:false,width:70},
            {field:'content',title:'视频流code',sortable:true,align:'center',width:70},
            {field:'rpId',title:'所属于资源商ID',sortable:true,align:'center',width:70},
            {field:'outId',title:'资源外部ID',sortable:true,align:'center',width:70},
            {field:'playAuth',title:'播放权限',sortable:true,align:'center',width:70},
            {field:'keyList',title:'关键字列表',sortable:true,align:'center',width:70},
            {field:'price',title:'单播价格',sortable:true,width:60},
            {field:'libUrl',title:'资源路径',sortable:true,align:'center',width:70},
            {field:'imgUrl',title:'资源导航图片',sortable:true,align:'center',width:70},
            {field:'playCount',title:'播放次数',sortable:true,align:'center',width:70},
            {field:'praiseCount',title:'点赞次数',sortable:true,align:'center',width:70},
            {field:'favorCount',title:'收藏次数',sortable:true,align:'center',width:70},
            {field:'description',title:'资源描述',sortable:true,align:'center',width:70},
            {field:'sort',title:'资源排序',sortable:true,align:'center',width:70},
            {field:'status',title:'开启状态',sortable:true,width:60}, 
            {field:'addTime',title:'添加时间',sortable:true,width:120}, 
        ]], 
        onMouseOverRow:function(e, rowIndex, rowData,field,value){
            
            if(field == 'imgUrl' && value != ''){
               var fieldValue = '';
               fieldValue = eval("rowData.realImgUrl");
               var imgArr = fieldValue.split(",");
               var imgStr = '';
               if(imgArr.length>1){
                    for(var i=0;i<(imgArr.length);i++){
                         imgStr += '<p><img src="'+imgArr[i]+'" /></p>';
                    }
               }else{
                    imgStr = '<p><img src="'+imgArr+'" /></p>';
               }
               $("#datagrid_img").html(imgStr);
               $("#datagrid_img").show();
               if($("#datagrid_img").height()+e.pageY > $(document).height()){
                    e.pageY = e.pageY-$("#datagrid_img").height();
               }
               $("#datagrid_img").css("left",e.pageX).css("top",e.pageY);
            }
       },  
       onMouseOutRow:function(e,rowIndex, rowData){  
           $("#datagrid_img").hide();
       },    
	    
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
	addData("添加","#edit_form",datagrid,"/System/Resource/add",edit_W,edit_H);
}
function edit(rowIndex,rowData){
	editData(rowIndex,rowData,"编辑",'#edit_form',datagrid,"/System/Resource/edit",edit_W,edit_H);
}
function del(){
	delData(datagrid,"/System/Resource/del");
}



	
	edit_W = 800;
	edit_H = 490;
	$("#where_chId").combobox({
		onSelect: function(param){
			//动态载入分类列表   
            var url = "<?php echo U('Class/index');?>" + "?getCombo=1&chId="+param.value;
            $('#where_classId').combobox("setValue","").combobox('reload', url);
            //动态载入专题列表
            url = "<?php echo U('Special/index');?>" + "?getCombo=1&chId=" + param.value;
            $("#where_specialId").combobox("setValue","").combobox('reload',url);               
        }
	});
	
    
    function batchData(){
        editDialog('批量处理','#batch_form',datagrid,"/System/Resource/batchData",700,390);
    }
    
    function exportData(){
        window.location="/System/Resource/exportData";
    }


</script>
</body>

	
</body>
</html>