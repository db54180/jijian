<?php
    Require_once("MySql.class.php");
    Require_once("MySqll.class.php");
    header("Content-type: text/html; charset=utf-8");

$account = $_POST['account'];
$pass = $_POST['pass'];
$gold_coin = $_POST['gold_coin'];
$silver_coin = $_POST['silver_coin'];
$xq =$_POST['pass'];

$CheckSum=strtoupper(md5(sprintf ("%s", $account). "" .sprintf ("%s",$pass). "" .sprintf ("%08X", ""). "" .sprintf ("%s", ""). "" .sprintf ("%08X", $gold_coin). "" .sprintf ("%08X", $silver_coin). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" ."ABCDEF"));

session_start();


$name=$_SESSION['username'];

$db1=new MySqll();//DB开始
$sql1 = "select dbip,dbname,dbpass from zhuce where acc='$name'";
$rows=$db1->sel1($sql1);
$host=$rows['dbip'];
$user=$rows['dbname'];
$password=$rows['dbpass'];

$db=new MySql($host,$user,$password,"","","");//DB结束

   $sql = "UPDATE account SET gold_coin='$gold_coin',silver_coin='$silver_coin',checksum='$CheckSum'  WHERE account='$account'";
   $db->exec($sql);
?>