<?php
require('./init.php');
//获取操作标识
$a=isset($_GET['action'])?$_GET['action']:"";
//文章分类具体功能
if($a=='add'){
    $data['name']=trim(htmlspecialchars($_POST['name']));
    //判断分类名称是否为空
    if($data['name']===''){
        $error[]='文章分类名称不能为空!';
    }else{
        //判断数据库中是否有同名的分类名称
        $sql="select id from cms_category where name=:name";
        if ( $db->data($data)->fetchRow($sql)){
            $error[]="该文章分类已存在";
        }else{
            //插入到数据库
            $sql="insert into cms_category(name)values(:name)";
            $db->data($data)->query($sql);
        }
    }
}
}
require './categoryListHtml.php';