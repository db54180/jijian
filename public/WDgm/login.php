<?php 
Require_once("MySqll.class.php");
 header("Content-Type:text/html;charset=utf-8"); 
 //error_reporting(0);
 session_start(); 

 
 
 
 if(isset($_POST['login'])) 
 { 
  $username = trim($_POST['username']); 
  $password = trim($_POST['password']); 
  if(($username=='')||($password=='')) 
  { 
   //header('refresh:3;url=login.html'); 
   echo "<script>alert('用户名或密码不能为空');window.location.href='login.html'</script>";
   exit; 
  } 
  
  else if(checkUser($username,$password)) 
  { 
   //登录成功将信息保存到session中 
   $_SESSION['username']=$username; 
   $_SESSION['islogin']=1; 
   //如果勾选7天内自动保存，则将其保存到cookie 
   if($_POST['remember']=="yes") 
   { 
    setcookie("username",$username,time()+7*24*60*60); 
    setcookie("code",md5($username.md5($password)),time()+7*24*60*60); 
   } 
   else
   { 
    setcookie("username",'',time()-1); 
    setcookie("code",'',time()-1); 
   } 
   //跳转到用户首页 
   //header('refresh:3;url=index.php'); 
   echo "<script>alert('登录成功');window.location.href='index.php'</script>";
  } 
  else
  { 
   //用户名或密码错误 
 
    echo "<script>alert('用户名或密码错误');window.location.href='login.html'</script>";
   exit; 
  } 
 } 
 
 
 
 function checkUser($username,$password){
 $conn=new Mysqll();
  $sql="select * from zhuce where acc='$username' and pw='$password'";
  $result=$conn->sel($sql);
  if($result){
    return true;
  }  
}
 
?>