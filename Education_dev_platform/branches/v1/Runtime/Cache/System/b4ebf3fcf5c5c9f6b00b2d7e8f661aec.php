<?php if (!defined('THINK_PATH')) exit();?><form id="edit_form" method="post" style="padding:10px">
<table class="editTable">
	<tr>
		<th>知识点名称</th>
		<td>
			<input type="hidden" id="id" name="id" value="<?php echo ($topic['id']); ?>"/>
			<input type="text" id="name" name="name" value="<?php echo ($topic['name']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>所属课程</th>
		<td>
			<input type="text" id="courseId" name="courseId" value="<?php echo ($topic['courseId']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>课时ID列表</th>
		<td>
			<input type="text" id="sectionIds" name="sectionIds" value="<?php echo ($topic['sectionIds']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>图片地址</th>
		<td>
			<textarea name="imgUrl" id="imgUrl" cols="50" rows="3"><?php echo ($topic['imgUrl']); ?></textarea>
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" 
				onclick="upfileDialog(1,'<?php echo ($thumb); ?>','知识点图片：<?php echo ($topic[name]); ?>',1,1,'#imgUrl','\r\n')"></a>
		</td>
	</tr>
	<tr>
		<th>知识点描述</th>
		<td>
			<textarea name="description" id="description" cols="50" rows="3"><?php echo ($topic['description']); ?></textarea>
		</td>
	</tr>
	<tr>
		<th>排序</th>
		<td><input type="text" id="sort" name="sort" value="<?php echo ($topic['sort']); ?>"/></td>
	</tr>
	<tr><th>状态</th><td><?php echo ($statusHtml); ?> <em>*</em></td></tr>
</table>
</form>