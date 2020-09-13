<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
  <title>注册用户</title> 
</head> 
<body> 
  <?php  
    Require_once("MySqll.class.php");
   $account = $_POST['username'];
  $pass = $_POST['password'];
 

$db1=new MySqll();//DB开始


	$query="select * from zhuce where acc ='{$account}'";
   
    $result=mysqli_query($db1->link,$query);
    $rn=mysqli_num_rows($result);
	
	if(!$result){
	echo "<script type='text/javascript'> alert('操作失败！！'); window.location.href='login.html'; </script>; " ;
	} elseif($rn>0){ 
	echo "<script type='text/javascript'> alert('用户已存在！！！'); window.location.href='login.html'; </script>; " ;
	}else{
	mysqli_query($db1->link,"INSERT INTO zhuce (acc, pw) VALUES ('{$account}', '$pass')") or die("存入数据库失败".mysqli_error()) ; 

     echo "<script type='text/javascript'> alert('注册成功！！！'); window.location.href='login.html'; </script>; " ;
	}

mysqli_close($link);
	
  ?> 
 
</body> 
</html>