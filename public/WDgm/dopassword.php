<?php
header("Content-type: text/html; charset=utf-8");
    Require_once("MySql.class.php");
    Require_once("MySqll.class.php");
$account = $_POST['account'];


$pass =$_POST['password'];

session_start();

echo $_SESSION['username'];
$name=$_SESSION['username'];

$db1=new MySqll();//DB开始
$sql1 = "select dbip,dbname,dbpass from zhuce where acc='$name'";
$rows=$db1->sel1($sql1);
$host=$rows['dbip'];
$user=$rows['dbname'];
$password=$rows['dbpass'];
echo $host;
$db=new MySql($host,$user,$password,"","","");//DB结束


$sql = "select * from account where account='$account'";
$res=$db->sel1($sql);


$gold_coin = $res['gold_coin'];
$silver_coin = $res['silver_coin'];
$xq =$res['privilege'];

$anma=strtoupper(md5($pass));
	$anma= "{$account}{$anma}20070201";
	$anma= strtoupper(md5($anma));
$CheckSum=strtoupper(md5(sprintf ("%s", $account). "" .sprintf ("%s",$anma). "" .sprintf ("%08X", "{$xq}"). "" .sprintf ("%s", ""). "" .sprintf ("%08X", $gold_coin). "" .sprintf ("%08X", $silver_coin). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" ."ABCDEF"));

$sql2 = "UPDATE account SET password='$anma',checksum='$CheckSum'  WHERE account='$account'";

$db->exec($sql2);


?> 