<?php 
class Goods{
  public $name;
  public $price;
  public $num; 
  public  function __construct($name,$price,$num)
  {
  	$this->name=$name;
  	$this->price=$price;
  	$this->num=$num;# code...
  }
  public function info(){
  	echo '商品名称是：'.$this->name.'<br>';
  	echo '商品价格是：'.$this->price.'<br>';
  	echo '商品数量是：'.$this->num.'<br>';
  }
  
 }
 
