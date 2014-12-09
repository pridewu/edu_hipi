<?php if (!defined('THINK_PATH')) exit();?><form id="edit_form" method="post" style="padding:10px">
<table class="editTable">
	<tr>
		<th>配置名称</th>	
		<td>
			<input type="hidden" name="id" value="<?php echo ($config['id']); ?>"/>
			<input type="text" id="name" name="name" value="<?php echo ($config['name']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>配置KEY</th>
		<td>
			<input type="hidden" name="cKey" value="<?php echo ($config['cKey']); ?>"/><?php echo ($config['cKey']); ?><em>*</em>
			<!-- <input type="text" id="cKey" name="cKey" value="<?php echo ($config['cKey']); ?>"/><em>*</em> -->
			&nbsp;&nbsp;备注：请勿使用下划线（_）
		</td>
	</tr>
	<tr>
		<th>配置文件</th>	
		<td>
			<?php if($config == null): ?><input type="text" id="templete" name="templete" value=""/>
			<?php else: ?>
				<input type="hidden" id="templete" name="templete" value="<?php echo ($config['templete']); ?>"/><?php endif; ?>
			<?php echo ($config['templete']); ?><em>*</em>&nbsp;&nbsp;备注：该文件必须先在Conf目录下添加
		</td>
	</tr>
</table>
</form>