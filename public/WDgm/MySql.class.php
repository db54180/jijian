<?php
header("Content-type: text/html; charset=utf-8");

class MySql{
	public $host;
	private $user;
	private $password;
	private $dbName;
	private $charset;
	private $port;
    public $link;
     function  __construct($host,$user,$password,$dbName,$charset,$port){
    
    $this->host = $host;
    $this->user = $user ? $user:"root";
    $this->password = $password;
    $this->dbName = $dbName ?$dbName:"dl_adb_all";
	
    $this->charset = $charset ?charset: "utf8";
    $this->port = $port ?$port:"3306";
 
	
    $this->link =mysqli_connect($this->host,$this->user,$this->password) or die("<br>数据库连接失败,请设置");	
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

	mysqli_close($this->link);

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
    mysqli_close($this->link);
  }
     public function close()
      {
       mysqli_close($this->link);
     }
}

?>