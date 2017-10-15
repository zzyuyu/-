<?php 
	require '../includes/common.php';	//引入common
	
	// 设置防止恶意调用和确定是否从写留言的表单提交的，此处省略

	// 好友通过验证
	if(isset($_GET['id'])&&$_GET['action']=='check'){
		$sql="UPDATE friend SET state=1 WHERE id='{$_GET['id']}';";
		$result=$_mysqli->query($sql);
		if($_mysqli->affected_rows==1){
			echo '<h1>成功</h1>';
			_location('center_friend.php');
			exit();
			
		}else{
			_alert_back('验证失败');
			exit();
		}
		
	}


	// 添加好友
	$to_user=$_POST['to_user'];
	$code_msg=$_POST['code_msg'];
	$from_user=$_COOKIE['username'];
	// echo $to_user.'|'.$code_msg;	

	// 增加之前，判断好友是否存在
	$sql="SELECT id FROM friend WHERE (to_user='{$to_user}' AND from_user='{$from_user}') OR (to_user='{$from_user}' AND from_user='{$to_user}');";
	$result=$_mysqli->query($sql);
	// echo $result->num_rows;	//表示sql语句影响的行数，返回0表示没找到
	if($result->num_rows!=0){
		_alert_back('你已发送过请求或对方已发送请求，请通过验证或等待验证！');
		die();
	}

	// 写入数据表
	$sql = "INSERT INTO friend(
							to_user,
							from_user,
							code_msg,
							date
							)
					VALUES (
							'{$to_user}',
							'{$from_user}',
							'{$code_msg}',
							NOW()
							);";

	if(!$result=$_mysqli -> query($sql)){
		echo '错了'.$_mysqli->error;
	}else{
		echo 'ok';
		// _location('blog.php');	
		_alert_back('申请成功，返回继续查看');
	}
	$_mysqli -> close();

 ?>