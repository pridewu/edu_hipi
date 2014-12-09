<?php if (!defined('THINK_PATH')) exit();?><form id="edit_form" method="post" style="padding:10px">
<table class="editTable">
	<tr>
		<th>配置说明</th>
		<td colspan="2">
			数组(Array)类型配制格式：一行一个元素，每行格式请参考配制项说明<br/>
			缩略图的配制格式：Key1=宽1*宽2,Key2=宽2*高2，如（b=600*600,m=200*200,s=80*80）
		</td>
	</tr>
	<tr>
		<th>配置名称</th>
		<td><?php echo ($name); ?><input type="hidden" name="id" value="<?php echo ($id); ?>"/></td>
		<td>&nbsp;</td>		
	</tr>	
	<tr><td colspan="3">&nbsp;</td></tr>
	<?php if(is_array($proConf)): foreach($proConf as $key=>$item): ?><tr><th><?php echo ($item['title']); ?></th>
			<td>
				<?php switch($item['type']): case "string": case "numeric": ?><input type="text" name="<?php echo ($key); ?>" value="<?php echo ($item[value]); ?>" style="width:320px;" /><?php break;?>
				<?php case "bool": ?><select name="<?php echo ($key); ?>" class="easyui-combobox">
						<option value="1" <?php echo ($item[value] ? 'selected' : ''); ?>>是</option>
						<option value="0" <?php echo ($item[value] ? '' : 'selected'); ?>>否</option>
					</select><?php break;?>
				<?php case "array": case "textarea": if($item['readonly']) $readOnly = 'readonly="readonly"'; ?>
                    <textarea name="<?php echo ($key); ?>" cols="<?php echo ($item['cols']?$item['cols']:50); ?>" 
                    		rows="<?php echo ($item['rows']?$item['rows']:8); ?>" <?php echo ($readOnly); ?>><?php echo ($item[value]); ?>
                    </textarea><?php break; endswitch;?>
			</td>
			<td>值类型：<?php echo ($item['type']); ?><br/><?php echo ($item['info']); ?></td>
		</tr><?php endforeach; endif; ?>	
</table>
</form>