

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>注销</title>
	
</head>
<body>
<?php 
	header('Content-type:text/html; charset=utf-8');
	error_reporting(0);
	// 注销后的操作
	session_start();
	// 清除Session
	$username = $_SESSION['username'];  //用于后面的提示信息
	$_SESSION = array();
	unset($_SESSION);
	session_destroy();
 
	// 清除Cookie
	setcookie('username', '', time()-99);
	setcookie('code', '', time()-99);
 
	// 提示信息
	echo "欢迎下次光临, ".$username.'<br>';
	echo "<a href='login.html'>重新登录</a>";
 
 ?>
</body>
</html>