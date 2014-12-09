<?php if (!defined('THINK_PATH')) exit();?>
<form id="upfile_form" method="post"  enctype="multipart/form-data">
	<table class="editTable">
	<tr>
		<th>文件类型</th>
		<td><?php echo ($typeName); ?><input type="hidden" name="fileType" value="<?php echo ($fileType); ?>"/></td>
	</tr>
	<tr>
		<th>允许扩展名</th>
		<td><?php echo ($exName); ?></td>
	</tr>
	<?php if($fileType == 1): ?><tr>
		<th>缩略图</th>
		<td><?php echo ($thumb); ?><input type="hidden" name="thumb" value="<?php echo ($thumb); ?>"/></td>
	</tr><?php endif; ?>
	<tr>
		<th>文件备注</th>
		<td><input type="text" name="memo" value="<?php echo ($memo); ?>" style="width:300px"/></td>
	</tr>
	<tr>
		<th>文件</th>
		<td>
			<div><input type="file" name="upFile[]" /></div>
			<?php if($isMore): ?><div id="more_file"></div>
				<input type="button" id="add_file" value="添加" /><?php endif; ?>
		</td>
	</tr>				
	</table>
</form>   	

<script>

$(function(){
	$("#add_file").click(function(){			
		$("#more_file").append("<div><input type='file' name='upFile[]' /> <input type='button' onclick='removeFile(this)' value='移除'/>");
	});
})
function removeFile(obj){
	$(obj).parent().remove();
}	
</script>