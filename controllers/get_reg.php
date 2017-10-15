<?php 
	require '../includes/common.php';	//引入common
	require '../includes/reg_valid.func.php';

	session_start();


	// 判断用户是否提交了	
	@$reg=$_POST['regform'];
	
	if($reg){
		if($_POST['yzm']==$_SESSION['code'] && $_SESSION['uniqid']==$_POST['uniqid']){
			
			$username=_check_username($_POST['username']);
			// echo "用户名是$username 啊";
			// echo $_SESSION['uniqid'].'|'.$_POST['uniqid'];
			$password=MD5($_POST['password']);
			$sex=$_POST['sex'];
			$photo=$_POST['photo'];
			$email=$_POST['email'];
			$tel=$_POST['tel'];
			$url=$_POST['url'];
			$uniqid=$_POST['uniqid'];
			$remote_addr=$_SERVER['REMOTE_ADDR'];




			// 增加之前，判断用户名是否存在
			$sql="SELECT username FROM users WHERE username='{$username}'";
			$result=$_mysqli->query($sql);
			// echo $result->num_rows;	//表示sql语句影响的行数，返回0表示没找到
			if($result->num_rows!=0){
				_alert_back('用户名已存在');
				die();
			}

			// 新增用户
			$sql = "INSERT INTO users(
										uniqid,
										username,
										password,
										sex,
										photo,
										email,
										tel,
										url,
										reg_time,
										last_login_time,
										last_login_ip
										)
								VALUES (
										'{$uniqid}',
										'{$username}',
										'{$password}',
										'{$sex}',
										'{$photo}',
										'{$email}',
										'{$tel}',
										'{$url}',
										NOW(),
										NOW(),
										'{$remote_addr}'
										);";	//REMOTE_ADDR表示客户端ip,使用{}表示强制解析

			
			if(!$_mysqli -> query($sql)){
				echo '错了'.$_mysqli->error;
			}
			// 虽然在footer中关闭了，但是这里也应该关闭一下
			$_mysqli -> close();

			// 注册成功，跳转到首页，函数写在核心函数库
			setcookie('username',$username,time()+3600,'/php/blog-1.1');
			_location('index.php');

			
		}else{
			echo '<script>history.back();</script>';
		}

	}else{
		echo '非法访问！';
	}

 ?>