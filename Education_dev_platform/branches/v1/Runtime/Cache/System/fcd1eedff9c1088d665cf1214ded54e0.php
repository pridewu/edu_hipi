<?php if (!defined('THINK_PATH')) exit();?><form id="edit_form" method="post" style="padding:10px">
<table class="editTable">
	<tr><th>标题</th><td><input type="text" id="title" name="title" value="<?php echo ($res['title']); ?>" style="width:200px;"/><em>*</em><input type="hidden" name="id" value="<?php echo ($res['id']); ?>"/></td></tr>	
	<tr><th>课时</th><td><input type="text" id="sectionId" name="sectionId" value="<?php echo ($res['sectionId']); ?>" style="width:200px;"/><em>*</em></td></tr>	
	<tr><th>视频流code：</th><td><textarea name="content" id="content" cols="50" rows="5"><?php echo ($res['content']); ?></textarea></td></tr>
	<tr><th>所属资源商</th><td><?php echo ($rpHtml); ?><em>*</em></td></tr>	
	<tr><th>资源外部ID</th><td><input type="text" id="outId" name="outId" value="<?php echo ($res['outId']); ?>"/></td></tr>	
	<tr><th>播放权限</th><td><input type="text" id="playAuth" name="playAuth" value="<?php echo ($res['playAuth']); ?>"/><em>*</em> (0－免费,1-收费(也可按产品会员等级编号填写))</td></tr>
	<tr><th>关键字列表</th><td><input type="text" id="keyList" name="keyList" value="<?php echo ($res['keyList']); ?>" style="width:200px;"/></td></tr>
	<tr><th>单播价格</th><td><input type="text" id="price" name="price" value="<?php echo ($res['price']); ?>"/> (权限为1时且产品为单资源购买类型有效)</td></tr>
	<tr><th>资源路径：</th><td><input type="text" id="libUrl" name="libUrl" value="<?php echo ($res['libUrl']); ?>" style="width:250px" /><em>*</em></td></tr>
	<tr><th>资源导航图片</th><td><input type="text" id="imgUrl" name="imgUrl" value="<?php echo ($res['imgUrl']); ?>" style="width:250px" /><a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="upfileDialog(1,'<?php echo ($thumb); ?>','资源导航图片：<?php echo ($res['imgUrl']); ?>',0,0,'#imgUrl')"></a></td></tr>	
	<tr><th>播放次数</th><td><?php echo ($res['playCount']); ?></td></tr>
	<tr><th>点赞次数</th><td><?php echo ($res['praiseCount']); ?></td></tr>
	<tr><th>收藏次数</th><td>	<?php echo ($res['favorCount']); ?></td></tr>
	<tr><th>资源描述</th><td><textarea name="description" id="description" cols="50" rows=5><?php echo ($res['description']); ?></textarea>	
	<tr><th>资源排序</th><td><input type="text" id="sort" name="sort" value="<?php echo ($res['sort']); ?>"/></td></tr>	
    <tr><th>开启状态</th><td><?php echo ($statusHtml); ?> <em>*</em></td></tr>
</table>
</form>