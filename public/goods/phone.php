<?php 
include "Goods.php";
class Phone extends Goods{
	public $brand;
	public $area;
	public function __construct($name,$price,$num,$brand,$area)
	{
		$this->brand=$brand;
		$this->area = $area;
		$this->name =$name;
        $this->price=$price;
        $this->num=$num;	
	}
	public function info(){
		parent::info();
		echo '品牌是：'.$this->brand.'<br>';
		echo '产地是：'.$this->area.'<br>';
	}
}

$obj=new Phone('手机',5500,99,'华为','深圳');
$obj->info();

 ?>