<?php
namespace app\index\controller;
use think\controller;
use app\index\model\Employees;
use app\index\model\Projection;
use think\Session;

Class Project extends Base{
	 public $pp;
	    
	  
	   
	  //新增项目页面
	  public function add_Project(){
		$permissions_info = $this->pp;
			   
		//获取公司员工列表
		//$employees = Db::table("employees");
		$e_info = Employees::all();
		//$e_info = $employees->select();  

		
		$this->assign("e_info",$e_info); 


		
		return $this->fetch();
	  }

	   //新增项目处理
	  public function do_add_project(){
		 $data['p_title'] = $_POST['p_title'];
		 $data['p_starttime'] = strtotime($_POST['p_starttime']);
		 $data['p_endtime'] = strtotime($_POST['p_endtime']);
		 $data['p_employees'] = implode("|",$_POST['employees_arr']);
		 $data['p_manage'] = $_POST['p_manage'];
		 $data['p_audit'] = $_POST['p_audit'];
		 $data['p_content'] = nl2br($_POST['p_content']);
		 
		 //$project = Db::table("project");
		 $project = Projection::create($data);
		 if($project){

			$this->success("项目创建成功",'Project/add_Project');  
		 }else{

			$this->error("项目创建失败"); 
		 }
	  }


	  //新建流程
	  public function liucheng(){
	  	$u_info = Employees::all();
	  	$this->assign("u_info",$u_info);





	  	return $this->fetch();
	  }

	  //流程处理

	  public function chuli(){
	  	
	  }










	   //管理项目
	  public function project(){
		  
		  $Uid = $_SESSION['UserId'];
		  

		  $p_info = Projection::all();
		  
		  for($i=0;$i<count($p_info);$i++){
			  $p_manage = explode("|",$p_info[$i]['p_manage']); 
			  $p_info[$i]['p_manage'] = $p_manage[1]; 
		  }
		  $this->assign("p_info",$p_info);
		  
		  return $this->fetch();  
	  }
	  
	  
	  	  //上传文档处理
	  public function do_projectUpload(){
		  $p_id = $_POST['pid'];
		  
		  $name=Session::get('u_username');
		  $file = request()->file("xiangmu_doc");

		  if($file){

        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.$p_id,$name);
        if(!$info){

        	echo "<script>alert('上传失败,请重新尝试!');</script>";
            
        }else{
            echo "<script>alert('上传成功!');</script>";
            // 成功上传后 获取上传信息

           
        }
    }

		  $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','doc','xls','wps','et','dps');// 设置附件上传类型
	      $upload->savePath =  './Public/project_doc/';// 设置附件上传目录
		  if(!$upload->upload()) {// 上传错误提示错误信息
		 	echo "<script>alert('对不起,上传失败,请重新尝试!!!');</script>";
	      }else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			$project = Db::table('project');
			$data['p_document'] = $info[0]['savename'];
			if($project->where("p_id = {$p_id}")->save($data)){
			   $this->Online($_SESSION['UserId']);
			   $this->Log($_SESSION['UserId'],"上传项目详细文档",1);
			   echo "<script>alert('文档上传成功!!!');</script>";
			}else{
			   $this->Online($_SESSION['UserId']);
			   $this->Log($_SESSION['UserId'],"上传项目详细文档",0);
			   echo "<script>alert('对不起,上传失败,请重新尝试!!!');</script>";
			}
		  }
	  } 


	  //项目文档处理

	  public function download()
    {
        $famlePath = $_GET['resum'];
        $file_dir = ROOT_PATH . 'public' . DS . 'uploads'.DS.$p_id . '/' . "$famlePath";    // 下载文件存放目录
        ROOT_PATH . 'public' . DS . 'uploads'.DS.$p_id,$name
        // 检查文件是否存在
        if (! file_exists($file_dir) ) {
            $this->error('文件未找到');
        }else{
            // 打开文件
            $file1 = fopen($file_dir, "r");
            // 输入文件标签
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length:".filesize($file_dir));
            Header("Content-Disposition: attachment;filename=" . $file_dir);
            ob_clean();     // 重点！！！
            flush();        // 重点！！！！可以清除文件中多余的路径名以及解决乱码的问题：
            //输出文件内容
            //读取文件内容并直接输出到浏览器
            echo fread($file1, filesize($file_dir));
            fclose($file1);
            exit();
        }
    }
 

	  
	  
	  
}

 ?>