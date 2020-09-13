<?php 
namespace app\admin\controller;
use \think\Db;
use \think\Controller;
use \think\Model;

class User extends Controller{

	public function test(){
		return '这是一个测试';
	}
   
   public function test1(){

   	return $this->fetch('user');//加载模板，渲染view下的user文件夹的user.html模板
   }

   /*public function add(){
   	if(Model::allowField(true)
   		->save(input('post.'))){  //为表单提交的用户数据

   		return '用户[.]新增成功'



   	}



   }*/
 

}

 ?>
