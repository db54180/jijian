<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>后台文章分类管理</h1>
<!--添加文章分类功能-->
<form action="?action=add" method="post">
    分类名称:<input type="text" name="name">
    <input type="submit" value="添加">
</form>


<!--展示文章分类功能-->
    <table border="1" cellpadding="3" cellspacing="0" width="20%">
        <tr bgcolor="skyblue">
            <td align="center">排序</td>
            <td>分类名称</td>
            <td align="center">操作</td>
        </tr>
        //遍历展示分类信息
        <?php foreach ($category as $v):?>
            <tr>
                <td><input type="text" name="<?php echo $v['id'];?>" value="<?php echo $v['sort'];?>"></td>
                <td><?php echo $v['name'];?></td>
                <td><a href="#">删除</a>|<a href="">编辑</a> </td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>




 