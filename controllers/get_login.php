<?php 
	require '../includes/common.php';	//引入common

	// 判断用户是否提交了	
	@$reg=$_POST['loginform'];		
	if($reg){
		$username=$_POST['username'];	
		$password=MD5($_POST['password']);

		$sql="SELECT * FROM users WHERE username='{$username}'";
		$result=$_mysqli->query($sql);
		if($result->num_rows!=0){
			$row=$result->fetch_assoc();			
			if($password===$row['password']){
				setcookie('username',$username,time()+3600,'/php/blog-1.1');
				_location('index.php');
			}else{
				_alert_back('密码错误');
			}
		}else{
			_alert_back('用户名不存在'); 
		}

	}else{
		echo '非法访问！';
	}

 ?>