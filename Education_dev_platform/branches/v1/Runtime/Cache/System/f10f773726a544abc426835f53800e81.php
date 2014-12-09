<?php if (!defined('THINK_PATH')) exit();?><form id="edit_form" method="post" style="padding:10px">
<table class="editTable">
	<tr>
		<th>上级栏目</th>
		<td><?php echo ($pIdHtml); ?><em>*</em></td>
	</tr>
	<tr>
		<th>栏目名称</th>
		<td>
			<input type="hidden" id="id" name="id" value="<?php echo ($channel['id']); ?>"/>
			<input type="text" id="name" name="name" value="<?php echo ($channel['name']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>栏目KEY</th>
		<td>
			<input type="text" id="chKey" name="chKey" value="<?php echo ($channel['chKey']); ?>"/><em>*</em>
		</td>
	</tr>	
	<tr>
		<th>导航图片</th>
		<td>
			<textarea name="imgUrl" id="imgUrl" cols="50" rows="3"><?php echo ($channel['imgUrl']); ?></textarea>
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" 
				onclick="upfileDialog(1,'<?php echo ($thumb); ?>','栏目导航图片：<?php echo ($channel[name]); ?>',1,1,'#imgUrl','\r\n')"></a>
		</td>
	</tr>		
	<tr>
		<th>跳转地址</th>
		<td>
			<input type="text" id="linkUrl" name="linkUrl" value="<?php echo ($channel['linkUrl']); ?>" style="width:250px;" />
		</td>
	</tr>
	<tr><th>在首页导航中</th><td><?php echo ($showHtml); ?> <em>*</em> 备注：对顶级栏目有效</td></tr>
	<tr>
		<th>说明</th>
		<td><textarea name="description" id="description" cols="50" rows=5><?php echo ($channel['description']); ?></textarea></td>
	</tr>
	<tr>
		<th>排序</th>
		<td><input type="text" id="sort" name="sort" value="<?php echo ($channel['sort']); ?>"/></td>
	</tr>
	<tr><th>状态</th><td><?php echo ($statusHtml); ?> <em>*</em></td></tr>
</table>
</form>