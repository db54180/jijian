<?php
header("Content-type: text/html; charset=utf-8");
$account = $_GET['account'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>密码修改</title>
	
</head>
  <script type="text/javascript"> 
    function check(form) { 
 
      if(form.password.value==''){
           alert('密码不能为空！');
         form.password.focus();
          return false;
          }

    } 
  </script> 
<body>
	<form name="form" onSubmit="return check(this)" action="dopassword.php" method='POST'>
		<table width="90%" align="center" border="1" bordercolor="#f0f0f0" rules="all" cellpadding="5">
        <input type ="hidden" value ="<?php echo $account ?>" name = 'account'><br>

		<tr>				
		  <td width="30%" align="right">帐号：</td> 
		 <td><?php echo $account?></td>
	    </tr>
		
		<tr>				
		  <td width="30%" align="right">密码：</td> 
		 <td> <input type= "text"style="height:30px" size = "30" name = "password"></td>
	    </tr>
		<tr>
		   <td>&nbsp;</td>	
		   <td> <input type = "submit" style="height:30px" size = "30"value = "提交修改"></td>
		</tr>
		</table>
	</form>
	
</body>
</html>