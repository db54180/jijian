<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<title>注册系统</title> 
</head> 
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=0.8, maximum-scale=0.8"/>
  <script type="text/javascript"> 
    function check(form) { 
       if(form.username.value==''){
        alert('用户名不能为空！');
            form.username.focus();
       return false;
           }
      if(form.password.value==''){
           alert('密码不能为空！');
         form.password.focus();
          return false;
          }

    } 
  </script> 
<body> 
<center>
 <div  style="margin-top: 50px">
	<form name="form"   method="post" onSubmit="return check(this)" action="doregister.php" >
	
		<div >
			<label for="account" align="right" style="height:30px" size = "30">账号</label>
			<div class="col-sm-10">
				<input type="text" style="display:inline-block;width:300px;height:30px" name="username"  placeholder="请输入账号">
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">密码</label>
			<div class="col-sm-10">
				<input type="password" style="display:inline-block;width:300px;height:30px" name="password"  placeholder="请输入密码">
			</div>
		</div>
		<div class="form-group">
			<label for="jyb" class="col-sm-2 control-label">金元宝</label>
			<div class="col-sm-10">
				<input type="text" style="display:inline-block;width:300px;height:30px" name="jyb" id="jyb" placeholder="请输入金元宝">
			</div>
		</div>
        <div class="form-group">
			<label for="yyb" class="col-sm-2 control-label">银元宝</label>
			<div class="col-sm-10">
				<input type="text" style="display:inline-block;width:300px;height:30px" name="yyb" id="yyb" placeholder="请输入银元宝">
			</div>
		</div>
        <div class="form-group">
			<label for="qx" class="col-sm-2 control-label">权限</label>
			<div class="col-sm-10">
				<input type="text" style="display:inline-block;width:300px;height:30px" name="qx" id="qx" placeholder="请输入权限">
			</div>
		</div>
         &nbsp&nbsp
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
		
				<button type="submit" style="display:inline-block;width:100px;height:30px">注&nbsp;&nbsp;册</button>
			</div>
		</div>
	</form>
</div>
</center>

</body> 
</html> 