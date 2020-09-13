<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Session;
error_reporting(E_ERROR | E_PARSE ); //如不加，会导致$session变量未定义

class Base extends Controller
{
    
    /*验证用户是否登陆*/


    public function _initialize(){

         date_default_timezone_set("Asia/Shanghai");
         //$_SESSION=Session::get();
        
         if(Session::get('Login')!=1){
            $this->redirect('login/login');
        
      }else{
     $uid=Db::table('employees')->field('u_id')->where("u_username = '{$_SESSION['u_username']}'")->find();
    Session::set('uid',$uid);



      } 


  }


          //日志记录函数
      public function Log($uid,$content,$status){
         $config = M("config");
         $log_info = $config->field("c_is_log")->find();
         if($log_info['c_is_log'] == 1){
         $log = M("log");
         $data['l_uid'] = $uid;
         $data['l_content'] = $content;
         $data['l_status'] = $status;
         $data['l_time']   = time();
         $log->add($data);  
         }
      }
      




    public function test(){

    	$db=Db::name('zhuce')->find();
    	$this->assign("$result",$db);

    	return $this->fetch();  

    }

    
}
