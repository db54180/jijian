<?php
header("Content-type: text/html; charset=utf-8");

class MySqll{
     private $host="140.249.23.1";
     private  $user="root";
     private  $password="90";
     private  $dbName="wg";           //数据库名
     private  $charset="utf8";          //字符编码
     private  $port="3306";            //端口号
     public  $link;
	
     public function  __construct(){
    
    $this->link = mysqli_connect($this->host,$this->user,$this->password) or die("数据库连接失败");	
    mysqli_set_charset($this->link,$this->charset);
	mysqli_select_db($this->link,$this->dbName);
     
	
   }
   
         
  
   
    function sel($sql){
		
		$obj = mysqli_query($this->link,$sql);
		$arra=array();//为了装结果集fetch 出来的多行数据。
		while ($res=mysqli_fetch_assoc($obj)){ //将结果集转换成二维数组
			$arra[]=$res;
		}
        return $arra;

	}
    
	    function sel1($sql){
		
		$obj = mysqli_query($this->link,$sql);//查询单行
        $res = mysqli_fetch_assoc($obj);
        return $res;

	mysqli_close($this->link);
	}
	
    
	
	 function exec($sql){
	  $result = mysqli_query($this->link,$sql);
	  
	   if($result){
	echo "<script>alert('修改成功!');window.location.href='index.php'</script>";
}
else{
	echo "<script>alert('修改失败!');window.location.href='index.php'</script>";
} 
    
  }
      function close()
      {
       mysqli_close($this->link);
     }
}

?>