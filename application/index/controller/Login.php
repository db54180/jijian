<?php 
namespace app\index\controller;
use app\index\model\Employees;
use app\index\model\Config;
use think\Controller;
use think\captcha\Captcha;
use think\Session;


class Login extends Controller{
	public function login()
	{
		 return $this->fetch();
	}



 



 /*
	   * 读条页面
	   */
	  public function dutiao(){
	  	
		 return $this->fetch();  
	  }
	  
	  /*
	   * 用户登陆验证处理页面
	   */
	  public function doLogin(){

		  //行验证码的验证
		  $where['u_username'] = $_POST['u_username'];
		  $where['u_password'] = md5($_POST['u_password']);
		  $where['u_enable']   = 1;
		  Session::set('u_username',$_POST['u_username']);
		  Session::set('u_password',$_POST['u_password']);


		
		  //查看OA平台是否开启
		 
		  $log_info = Config::get(1)->getData();
		   



		  if($log_info['c_switch']!=1){
			 $this->error("对不起,平台已关闭...");  
		  }
		  
		  //查看登陆时段是否限制,如限制根据限制时间进行处理
		  if($log_info['c_is_loginTime']==1){
		     $nowTime   =time();
			 $logTime   =explode("-",$log_info['c_logTime']);
			 $startTime =strtotime($logTime[0])."<hr/>";
			 $endTime   =strtotime($logTime[1])."<hr/>";
			 if($startTime > $endTime){
			 	if(($nowTime<$startTime)&&($nowTime>$endTime)){
				 	//允许登陆向下执行 
			 	}else{
				 	$this->error("对不起,本时间段禁止登陆");
			 	}
			 }else{
				if(($nowTime>$startTime)&&($nowTime<$endTime)){
				 	$this->error("对不起,本时间段禁止登陆");
			 	}else{
				 	//允许登陆向下执行
			 	}  
			 }
		  }
		  
		  
		  //用户名和密码的验证
	
		  //$arr = Db::table('employees')->where($where)->find(); //where $where(u-name,u-pwd,u-enable) 均为true
		  
		  $arr = Employees::get($where);
		  
		  //$enable = Db::table('employees')->field("u_enable")->where("u_username = '{$_POST['u_username']}'")->find();
		  $where1 = function($query){
		  	$query ->field('u_enable')
		  	->where('u_username','=',$_POST['u_username']);
		  };
		  $enable = Employees::get($where1)?Employees::get($where1)->getData():0;
		  //$uid=Db::table('employees')->field("u_id")->where("u_username = '{$_POST['u_username']}'")->find();
		  $where2 = function($query){
		  	$query->field('u_id')
		  	->where('u_username','=',$_POST['u_username']);
		  };

		  $uid = Employees::get($where2)?Employees::get($where2)->getData():null;


		  if($enable['u_enable']!=1){  //u_enable列代表是否被允许登陆 ，进行验证
			 $this->error("对不起,请联系管理员"); 
		  }
	
		  if($arr){
			 /*session('Login',true); //判断 次参数是否为1，是否为登陆状态
			 session('UserName',$where['u_username']);   
			 session('UserId',$arr['u_id']);
			 session('LoginTime',time());
			 
			 //如果成功创建一个文件			 
			 touch("./Public/online_employees/".$arr['u_id'].".txt");
			 $online = M("online");
			 $data['o_time'] = time();
			 $online->where("o_uid = {$arr['u_id']}")->save($data);  //保存登陆时间到 online表
			 
 			 //判断是否开启日志记录  
			 if($log_info['c_is_log'] == 1){  //读取config 里面的是否开启日志信息
			 $data['l_uid'] = $arr['u_id'];
			 $data['l_content'] = "登陆OA";
			 $data['l_time'] = time();
			 $data['l_status'] = 1;
			 $log->add($data);
			 }*/
			 Session::set('Login',1);
			 
             Session::set('uid',$uid);

		
			 
			 $this->redirect("Login/dutiao");  //重定向到读条界面
		  }else{
			 
			 /*if($log_info['c_is_log'] == 1){
			 $data['l_uid'] = $arr['u_id'];
			 $data['l_content'] = "登陆OA";
			 $data['l_time'] = time();
			 $data['l_status'] = 0;
			 $log->add($data);
			 }
			 //查看是否开启了登陆报警
		     if($log_info['c_is_loginWarning']==1){
				
				$_SESSION['NUM']--;
				if($_SESSION['NUM']==0){
				   $save['u_enable'] = 0;
				   $user->where("u_username = '{$_POST['u_username']}'")->save($save);
				   unset($_SESSION['NUM']);
				   $this->error("对不起,由于你尝试指定次数未登陆成功,触发警报,您的账号将被锁定,如需解锁请联系管理员");
				}
			    $this->error("用户登陆失败,请重新尝试,剩余尝试次数:{$_SESSION['NUM']}次"); 
			 }else{*/
				$this->error('用户登陆失败,请重新尝试!!!');  
//			 }
		  }
	  }
	  
	  /*
	   * 用户注销处理
	   */
	  public function doLogout(){
		/*  $Time = $_SESSION['LoginTime'];
		  $Uid  = $_SESSION['UserId'];
		  $_SESSION = array();
		  if(isset($_COOKIE[session_name()])){
			  setcookie(session_name(),'',time()-1,'/');  
		  }*/
		  session_unset();
		  //session_destroy();
		  /*unlink("./Public/online_employees/".$Uid.".txt");
		  $log = M("log");
		  
		  $config = M("config");
		  $log_info = $config->field("c_is_log")->find();
		  
		  if($log_info['c_is_log'] == 1){
		  $data['l_uid'] = $Uid;
		  $data['l_content'] = "退出OA";
		  $data['l_time'] = time();
		  $data['l_status'] = 1;
		  $log->add($data);
		  }*/
		  $this->success('注销成功,谢谢','Login/login',3);
	  }
  }

?>

 