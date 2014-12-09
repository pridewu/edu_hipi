<?php if (!defined('THINK_PATH')) exit();?><form id="edit_form" method="post" style="padding:10px">
<table class="editTable">
	<tr>
		<th>用户id</th>
		<td>
			<input type="hidden" id="id" name="id" value="<?php echo ($Role['id']); ?>"/>
			<input type="text" id="userId" name="userId" value="<?php echo ($Role['userId']); ?>"/><em>*</em>
		</td>
	<tr>
		<th>段龄ID</th>
		<td>
			<input type="text" id="stageId" name="stageId" value="<?php echo ($Role['stageId']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>用户性别</th>
		<td>
			<input type="text" id="sex" name="sex" value="<?php echo ($Role['sex']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>角色昵称</th>
		<td>
			<input type="text" id="nickName" name="nickName" value="<?php echo ($Role['nickName']); ?>"/><em>*</em>
		</td>
	</tr>
	<tr>
		<th>兴趣爱好</th>
		<td>
			<input type="text" id="interests" name="interests" value="<?php echo ($Role['interests']); ?>"/>
		</td>
	</tr>


	<tr>
		<th>强项</th>
		<td>
			<input type="text" id="advantage" name="advantage" value="<?php echo ($Role['advantage']); ?>"/>
		</td>
	</tr>
	<tr>
		<th>弱项</th>
		<td>
			<input type="text" id="disAdvantage" name="disAdvantage" value="<?php echo ($Role['disAdvantage']); ?>"/>
		</td>
	</tr>
	<tr>
		<th>荣誉等级</th>
		<td>
			<input type="text" id="level" name="level" value="<?php echo ($Role['level']); ?>"/>
		</td>
	</tr>
	<tr>
		<th>积分</th>
		<td>
			<input type="text" id="point" name="point" value="<?php echo ($Role['point']); ?>"/>
		</td>
	</tr>
	<tr>
		<th>头像</th>
		<td><input type="text" id="face" name="face" value="<?php echo ($Role['face']); ?>"/></td>
	</tr>
	<tr><th>状态</th><td><?php echo ($statusHtml); ?> <em>*</em></td></tr>
</table>
</form>