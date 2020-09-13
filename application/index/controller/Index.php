<?php
namespace app\index\controller;
use \think\Db;
use \think\Controller;  
use \think\session;

class Index extends Base
{
    public function index ()
    {
        return $this->fetch();
    }


    /*
     * OA顶部页面
     */
    public function top(){  
        $this->assign("now_time",time());  //获取当前时间从前台显示
        
        $name=Session::get('u_username');
        $names=Db::table("employees")->where("u_username = '$name'")->select();
        $namess=$names["0"]["u_name"];
        $this->assign('namess',$namess);
       /* $company = M("company");
        $c_info = $company->field("c_site_url")->find();
        $this->assign("site_url",$c_info['c_site_url']);*/
        return $this->fetch();   
    }   
    
    /*
     * OA左侧导航页面
     */
    public function menu(){ 
        return $this->fetch();
       
    }



    /*
     * OA主内容页面
     */
    public function main(){
        //登陆成功后根据ID获取相应的用户信息
        $uid  = session('uid');
        $user = M('employees'); 
        //多表查询，同时查询用户信息表，部门表，职位表
        $sql = "select * from oa_department as d,oa_employees as e,oa_position as p where (e.u_department = d.d_id or e.u_department = 0) and e.u_position = p.p_id and e.u_id = {$Uid}";
        $user_info = $user->query($sql);
        $this->assign("user_info",$user_info);      
        /*查询所属该用户的公告通知*/
        //查出用户所属部门ID
            $user   = M("employees");           
            $u_info = $user->field("u_department")->find($Uid);
            
            $notice = M("notice");
            $department = M("department");
            
            //分页处理部分
            $count = $notice->where("(n_target = 2 or n_department = {$u_info['u_department']}) and n_rUid != {$Uid}")->count();
            
            //查询出本部门所发公告或者所有员工接收的公告(排除自身所发公告)
            $n_info = $notice->where("(n_target = 2 or n_department = {$u_info['u_department']}) and n_rUid != {$Uid}")->limit(7)->select();
            
            //通过内部循环将部门ID换成部门名称
            for($i=0;$i<count($n_info);$i++){
                $d_info = $department->where("d_id = {$n_info[$i]['n_department']}")->select();
                $n_info[$i]['n_department'] = $d_info[0]['d_name'];
            }           
            if(empty($n_info)){
               $this->assign("n","2");  
            }else{
               $this->assign("n","1");  
            }
            $this->assign("n_info",$n_info);
            
            /*查询出公共聊天室信息*/
            $chatroom = M("chatroom");
            $c_info = $chatroom->limit(8)->select();
            if(empty($c_info)){
               $this->assign("c","2");  
            }else{
               $this->assign("c","1");  
            }
            $this->assign("c_info",$c_info);
            
            /*调取员工的工作日志*/
            $joblog = M("joblog");
            $j_info = $joblog->where("j_uid = {$Uid}")->select();
            $this->assign("j_info",$j_info);
            
            /*调取个人的办公桌布局*/
            if($user_info[0]['u_window']==1){
               $absolute = M("absolute");
               $ab_info = $absolute->where("a_uid = {$Uid}")->order("a_sid asc")->select();
               $this->assign("ab_info",$ab_info);
            }
            
            /*查询拖动的版块ID*/
            $section = M("section");
            $section_info = $section->select();
            $this->assign("section_info",$section_info);
            
            /*调取个人文件柜*/
            $filecabinet = M("filecabinet");
            $f_info = $filecabinet->where("f_uid = {$Uid}")->limit(5)->select();
            $this->assign("f_info",$f_info);
            
            /*获取系统当前时间*/
            $this->assign("now_time",time());
            //获取当天日期
            $this->assign("now_day",date("Y-m-d",time()));
            
            /*获取常用网址*/
            $url = M("url");
            $u_info = $url->where("u_uid = {$Uid}")->order("u_number asc")->select();
            $this->assign("u_info",$u_info);
            
            /*获取公司当天的紧急通知*/
            $jinji = M("jinji");
            $jinji_date = date("Y-m-d",time());
            $j_info = $jinji->select();
            for($j=0;$j<count($j_info);$j++){
                $j_time = date("Y-m-d",$j_info[$j]['j_starttime']);
                if($jinji_date == $j_time){
                   $this->assign("jinji_info",$j_info[$j]);
                }
            }
            
            //获取到会议信息
            $meet = M("meetingnotice");
            $sql2 = "select * from oa_meeting as m,oa_meetingnotice as mn where m.m_id = mn.n_mid and (mn.n_department = {$user_info[0]['u_department']} or mn.n_uid = {$Uid}) order by m.m_starttime desc limit 0,7";
            $meet_info = $meet->query($sql2);
            $this->assign("meet_info",$meet_info);
            
            //获取到公司基本信息
            $company = M("company");
            $company_info = $company->select();
            $this->assign("company_info",$company_info);
            
            //获取到投票信息
            $vote = M("voteinfo");
            $now_t = time();
            $v_info = $vote->where("v_display = 1 and v_endtime > {$now_t}")->order("v_id desc")->limit(4)->select();
            $this->assign("v_info",$v_info);
            $this->display();   
    }
    
    //主页面AJAX处理部分
    public function main_ajax(){
       $Uid = $_SESSION['UserId'];
       $nowTime = $_GET['nowTimes'];
       $memo = M("memo");
       $m_info = $memo->field("m_msg")->where("m_time = '{$nowTime}' and m_uid = {$Uid}")->find();  
       if(empty($m_info)){
          echo "当天没有设置备忘录信息..."; 
       }else{
          echo $m_info['m_msg'];  
       }
    }
    
    
    
    
}
