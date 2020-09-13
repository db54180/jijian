<?php 
class MysqlPdo{
	private $dbConfig=(
		'db'=>'mysql',
		'host'=>'localhost',
		'port'=>'3306',
		'user'=>'root',
		'pwd'=>'root',
		'charset'=>'utf8',
		'dbname'=>''
	);
	private static $instance;//单例模式
	private $db;//PDO实例
	private $data=array();//操作数据


	private function __construct($params){
		$this->dbConfig=array_merge($this->dbConfig,$params);
		//两个数组合并为一个数组
		$this->connect();//调用当前类对象中的connect方法

	}
//连接服务器
	function connect(){
		$dsn="$this->dbConfig['db']:host={$this->dbConfig['host']};dbname={$this->dbConfig['dbname']};charset={$this->dbConfig['charset']}";

		//$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; PDP格式
		try{
			//实例化PDO
			$this->db=new PDO($dsn;$this->dbConfig['user'];$this->dbConfig['pwd']);
		}catch(PDOException $exception){
			die("数据库连接失败".mysql_error());

		};
	}

	public static function getInstance($params=array()){

		if(!isset(self::$instance)
		{
			self::$instance=new self($params);

		}
		return self::$instance;
	}

	private function __clone(){
		trigger_error("not allow to clone");
	}
    //通过预处理方式执行sql
	public function query($sql,$batch=false){
		$data=$batch?$this->data : array($this->data);
		$this->data=array();

	
	//通过预处理方式执行SQL
	$stmt=$this->db->prepare($sql);
	foreach ($data as $v) {
		if($stmt->execute($v===false)){
			die("数据库预处理失败");
		}
	}
	return $stmt;
    }

    public function data($data){
    	$this->data=$data;
    	return $this;//返回对象自身用于连贯操作
    }
    //取得一行结果
    public function fetchRow($sql){
    	return $this-query($sql)->fetch(PDO::FETCH_ASSOC);
    	//返回索引数组
    }

    //取得多行结果
    public function fetchAll($sql){
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }




}
 ?>
