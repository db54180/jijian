<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
  <title>注册用户</title> 
</head> 
<body> 
  <?php  
    session_start(); 
   Require_once("MySql.class.php");
    Require_once("MySqll.class.php");
   $account = $_POST['username'];
  $pass = $_POST['password'];
  $gold_coin = $_POST['jyb'];
  $silver_coin = $_POST['yyb'];
  $xq =$_POST['qx'];

	$anma=strtoupper(md5($pass));
	$anma= "{$account}{$anma}20070201";
	$anma= strtoupper(md5($anma));
	$CheckSum=strtoupper(md5(sprintf ("%s", $account). "" .sprintf ("%s",$anma). "" .sprintf ("%08X", "{$xq}"). "" .sprintf ("%s", ""). "" .sprintf ("%08X", $gold_coin). "" .sprintf ("%08X", $silver_coin). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" .sprintf ("%s", ""). "" ."ABCDEF"));

   
 
$name=$_SESSION['username'];

$db1=new MySqll();//DB开始
$sql1 = "select dbip,dbname,dbpass from zhuce where acc='$name'";
$rows=$db1->sel1($sql1);
$host=$rows['dbip'];
$user=$rows['dbname'];
$password=$rows['dbpass'];

$db=new MySql($host,$user,$password,"","","");//DB结束

	$query="select * from account where account ='{$account}'";
    $result=mysqli_query($db->link,$query);
    $rn=mysqli_num_rows($result);
	
	if(!$result){
	echo "<script type='text/javascript'> alert('操作失败！！！'); window.location.href='register.php'; </script>; " ;
	} elseif($rn>0){ 
	echo "<script type='text/javascript'> alert('用户已存在！！！'); window.location.href='register.php'; </script>; " ;
	}else{
	mysqli_query($db->link,"INSERT INTO account (account, blocked_time, blocked_reason, temp_blocked_time, temp_blocked_reason, password, protect, auto_lock, locked, gold_coin, silver_coin, limit_trade_coin, trade_lock_time, name, birthday, id_type, id_num, tel, mobile, email, time, active_time, first_login_time, privilege, account_id, permit_ip, permit_id, ip, adult, checksum, coin_password, unlock_coin_password_time, org_password, org_permit_ip, memo, last_login_ip, last_login_time, last_login_id, presentee, reg_date, active_path, trade_coin, last_trade_coin, consum_coin, last_consum_coin) VALUES ('{$account}', '', '', '', '', '{$anma}', '', '0', '', '{$gold_coin}', '{$silver_coin}', '0', '', '', '', '', '', '', '', '', '0', '', '20170728030802', '{$xq}', '', '', '', '', '1', '{$CheckSum}', '', '', '', '', '', '127.0.0.1', '20170728030753', '', '0', '', '0', '0', '', '1', '20170728031227')") or die("存入数据库失败".mysql_error()) ; 

     echo "<script type='text/javascript'> alert('注册成功！！！'); window.location.href='index.php'; </script>; " ;
	}

$db->close();
	
  ?> 
 
</body> 
</html>