<?php 
	require '../includes/common.php';	//引入common
	require '../includes/reg_valid.func.php';


	if(@$_POST['editor_form']){
		// echo 'shoudao';
		// 引入 reg_valid.func.php ，进行服务器端的各种验证

		// 前台页面提交前，应进行数据是否有变化的验证

		// 当进行敏感操作时，应该将唯一标识符设置到cookie里，并与数据库中的唯一标识符对比，这样会更安全，再安全一下，对比一下id，再再安全一下，每次进行敏感操作，从新生成唯一标识符存入数据库，由于之前没有将uniqid存如cookie，此处就过了


		$username=_check_username($_POST['username']);
		$sex=$_POST['sex'];
		$photo=$_POST['photo'];
		$email=$_POST['email'];
		$tel=$_POST['tel'];
		$url=$_POST['url'];
		// 验证通过后，进行数据更新

		
		$cookie_name=$_COOKIE['username'];
		// 更新用户资料
		$sql = "UPDATE users SET
								username='{$username}',
								sex='{$sex}',
								photo='{$photo}',
								email='{$email}',
								tel='{$tel}',
								url='{$url}'

							WHERE username='{$cookie_name}';";		
	
		$result=$_mysqli -> query($sql);
		if(!$result){
			_alert_back('sql语句错误！');
			die();
		}else{
			echo '成功！';
			$_mysqli -> close();
			setcookie('username',$username,time()+3600,'/php/blog-1.1');
			// _location('center.php');		
		}
	}else{
		_alert_back('非法访问！');
	}
 ?>		