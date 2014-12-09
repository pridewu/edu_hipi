<?php if (!defined('THINK_PATH')) exit();?><form id="edit_form" method="post" style="padding:10px">
<table class="editTable">

	<tr>
		<th>公告名称</th>
		<td>
			<input type="hidden" id="id" name="id" value="<?php echo ($notice['id']); ?>"/>
			<textarea name="content" id="description" cols="50" rows="3"><?php echo ($notice['content']); ?></textarea>
			<em>*</em>
		</td>
	</tr>
	
	<tr>
		<th>通知Key</th>
		<td>
			<input type="text" id="noticeKey" name="noticeKey" value="<?php echo ($notice['noticeKey']); ?>"/><em>*</em>
		</td>
	</tr>

	<tr><th>状态</th><td><?php echo ($statusHtml); ?> <em>*</em></td></tr>
</table>
</form>