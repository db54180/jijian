<?php
   Require_once("MySqll.class.php");
header("Content-type: text/html; charset=utf-8");

$acc = $_POST['acc'];
$dbip = $_POST['dbip'];
$user = $_POST['user'];
$pw =$_POST['pw'];


$db1=new MySqll();
$sql = "UPDATE zhuce SET dbip='$dbip',dbname='$user',dbpass='$pw'  WHERE acc='$acc'";

$db1->exec($sql);
$db1->close();

?>