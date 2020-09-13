<?php
header("Content-type: text/html; charset=utf-8");
  Require_once("MySql.class.php");
Require_once("MySqll.class.php");

$account = $_GET['account'];
session_start();

$name=$_SESSION['username'];
$db1=new MySqll();

$sql1 = "select dbip,dbname,dbpass from zhuce where acc='$name'";
$rows=$db1->sel1($sql1);
$host=$rows['dbip'];
$user=$rows['dbname'];
$password=$rows['dbpass'];

$db=new MySql($host,$user,$password,"","","");



$sql = "select * from account where account='$account'";
$res=$db->sel1($sql);




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>执行修改</title>
	
</head>
<body>
	<form name="form1" action="doupdate.php"method='POST'>
		<table width="90%" align="center" border="1" bordercolor="#f0f0f0" rules="all" cellpadding="5">

		<input type ="hidden" value ="<?php echo $res['account'] ?>" name = 'account'><br>
		<input type ="hidden" value ="<?php echo $res['password'] ?>" name = 'pass'><br>
		<input type ="hidden" value ="<?php echo $res['privilege'] ?>" name = 'xq'><br>
		<tr>				
		  <td width="30%" align="right">帐号：</td> 
		 <td><?php echo $res['account']?></td>
	    </tr>
		
		<tr>				
		  <td width="30%" align="right">金元宝：</td> 
		 <td> <input type= "text"style="height:30px" size = "30"value="<?php echo $res['gold_coin']  ?>" name = "gold_coin"></td>
	    </tr>

	    <tr>	    
		  <td width="30%" align="right">银元宝：</td>  
		 <td> <input type = "text" style="height:30px" size = "30"value="<?php echo $res['silver_coin'] ?>" name = "silver_coin"></td> 
        </tr>

		<tr>
		   <td>&nbsp;</td>	
		   <td> <input type = "submit" style="height:30px" size = "30"value = "提交修改"></td>
		</tr>
		</table>
	</form>
	
</body>
</html>