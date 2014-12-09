<?php if (!defined('THINK_PATH')) exit();?><form id="edit_form" method="post" style="padding:10px">
<table class="editTable">
	<tr>
		<th>课程名称</th>
		<td>
			<input type="hidden" id="id" name="id" value="<?php echo ($course['id']); ?>"/>
			<input type="text" id="name" name="name" value="<?php echo ($course['name']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr><th>所属栏目</th><td><?php echo ($channelHtml); ?> <em>*</em></td></tr>
	<tr><th>龄段</th><td>
		<input type="hidden" id="aastage" name="stage" value="<?php echo ($course['stage']); ?>"/>
		<input id="combobox_stage"  class="easyui-combobox" data-options="valueField:'id',textField:'name'" style="width:150px" /> (支持多选)
	</td></tr>
	<tr><th>出版商</th><td><?php echo ($pressHtml); ?> <em>*</em></td></tr>
	<tr><th>学期</th><td><?php echo ($sessionHtml); ?> <em>*</em></td></tr>
	<tr><th>类型</th><td><?php echo ($typeHtml); ?> <em>*</em></td></tr>
	<tr><th>科目</th><td><?php echo ($subjectHtml); ?> <em>*</em></td></tr>
	<tr>
		<th>价格</th>
		<td>
			<input type="text" id="price" name="price" value="<?php echo ($course['price']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>期中考试题库ID</th>
		<td>
			<input type="text" id="midLibId" name="midLibId" value="<?php echo ($course['midLibId']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>期末考试题库ID</th>
		<td>
			<input type="text" id="finalLibId" name="finalLibId" value="<?php echo ($course['finalLibId']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>知识点ID</th>
		<td>
			<input type="text" id="topicIds" name="topicIds" value="<?php echo ($course['topicIds']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr><th>关键字</th><td>
		<input type="hidden" id="aakeys" name="keys" value="<?php echo ($course['keys']); ?>"/>
		<input id="combobox_keys"  class="easyui-combobox" data-options="valueField:'id',textField:'name'" style="width:150px" /> (支持多选)
	</td></tr>
	<tr>
		<th>图片地址</th>
		<td>
			<textarea name="imgUrl" id="imgUrl" cols="50" rows="3"><?php echo ($course['imgUrl']); ?></textarea>
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" 
				onclick="upfileDialog(1,'<?php echo ($thumb); ?>','课程图片：<?php echo ($course[name]); ?>',1,1,'#imgUrl','\r\n')"></a>
		</td>
	</tr>
	<tr>
		<th>链接地址</th>
		<td>
			<input type="text" id="linkUrl" name="linkUrl" value="<?php echo ($course['linkUrl']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>机构</th>
		<td>
			<input type="text" id="organization" name="organization" value="<?php echo ($course['organization']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>讲师</th>
		<td>
			<input type="text" id="lecturer" name="lecturer" value="<?php echo ($course['lecturer']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>课程描述</th>
		<td>
			<textarea name="description" id="description" cols="50" rows="3"><?php echo ($course['description']); ?></textarea>
		</td>
	</tr>
	<tr>
		<th>排序</th>
		<td><input type="text" id="sort" name="sort" value="<?php echo ($course['sort']); ?>"/></td>
	</tr>
	<tr><th>状态</th><td><?php echo ($statusHtml); ?> <em>*</em></td></tr>
</table>
</form>

<script>
$(function(){	
	
	/* 龄段多选框  */
	$("#combobox_stage").combobox({
		multiple:true,
		separator:',',
		onSelect: function(){			
			var vals = $("#combobox_stage").combobox('getValues');
			$("#aastage").val(vals);
		},
		onUnselect:function(){
			var vals = $("#combobox_stage").combobox('getValues');
			$("#aastage").val(vals)
		},	
		onLoadSuccess: function(){
			$("#combobox_stage").combobox("setValues","<?php echo ($course['stage']); ?>".split(','));
		},		
	}).combobox('reload',"<?php echo U('Course/load');?>" + "?type=stage");
	
	/* 关键字多选框  */
	$("#combobox_keys").combobox({
		multiple:true,
		separator:',',
		onSelect: function(){			
			var vals = $("#combobox_keys").combobox('getValues');
			$("#aakeys").val(vals);
		},
		onUnselect:function(){
			var vals = $("#combobox_keys").combobox('getValues');
			$("#aakeys").val(vals)
		},	
		onLoadSuccess: function(){
			$("#combobox_keys").combobox("setValues","<?php echo ($course['keys']); ?>".split(','));
		},		
	}).combobox('reload',"<?php echo U('Course/load');?>" + "?type=key");
		
});

</script>