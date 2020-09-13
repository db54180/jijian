<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=0.8, maximum-scale=0.8"/>
	<title>问道管理系统</title>
	
</head>


<body>

<div >

<table align="center"  width="90%" >
		<caption><h1>问道管理页面</h1></caption>
<?php
 error_reporting(0);
Require_once("Mysql.class.php");
Require_once("Mysqll.class.php");
header("Content-type: text/html; charset=utf-8");
	session_start();
		if (isset($_COOKIE['username'])) {
		# 若记住了用户信息,则直接传给Session
		$_SESSION['username'] = $_COOKIE['username'];
		$_SESSION['islogin'] = 1;
	}
	if (isset($_SESSION['islogin'])) {
		// 若已经登录
				$str='<form  action="dodb.php" method="POST">
		<table >
		<input type ="hidden" value ="';
		$str1='" name = "acc"><br>
		<tr>				
		 <td> <input type= "text" style="width:100px;border-color:#00f " name = "dbip" placeholder="数据库IP"></td>
		 <td> <input type= "text"style="width:100px;border-color:#00f" name = "user" placeholder="数据库用户名"></td>
		 <td> <input type = "text" style="width:100px;border-color:#00f" name = "pw" placeholder="数据库密码"></td> 	
		 <td> <input type = "submit" style="height:20px" size = "20"value = "提交修改"></td>
		</tr>
		</table>
	</form>';
	echo $str.$_SESSION['username'].$str1;
		echo "<div>道友".$_SESSION['username'].' ,好久不见!&nbspby:330224708</div><br>';
		
		echo "<a href='logout.php'>注销</a>";

	
	} else {
		// 若没有登录
		header('refresh:0.05;url=login.html');
		//echo "您还没有登录,请<a href='login.html'>登录</a>";
	}
	$name=$_SESSION['username'];

$db1=new Mysqll();

$sql1 = "select dbip,dbname,dbpass from zhuce where acc='$name'";
$obj = mysqli_query($db1->link,$sql1);


$rows = mysqli_fetch_assoc($obj);
$host=$rows['dbip'];
$user=$rows['dbname'];
$password=$rows['dbpass'];


$db=new Mysql($host,$user,$password,"","","");

$sql = "select account,gold_coin,silver_coin from account";
$arra=$db->sel($sql);


    
   echo '<div ><a href = "register.php">账号注册</a></div>';  
  echo '<table align="center" width = "90%" border = "2" rules="all">';
  echo '<th>角色名</th><th>金元宝</th><th>银元宝</th><th>操作</th>';
  
  
  foreach($arra as $rows){
	   echo "<tr>";
	echo '<td>'.$rows['account'].'</td>';
	echo '<td>'.$rows['gold_coin'].'</td>';
	echo '<td>'.$rows['silver_coin'].'</td>';
	echo '<td><a href = "update.php?account='.$rows['account'].'">充值/</a><a href = "password.php?account='.$rows['account'].'">改密</a></td>';
    echo '</tr>';
  }

  	echo '</table>';

	
	?>
	</table>  


	</div>
</body>
</html>