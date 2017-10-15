<?php 
	require '../includes/common.php';	//引入common
	
	// 设置防止恶意调用和确定是否从写留言的表单提交的，此处省略

	$to_user=$_POST['to_user'];
	$msg_content=$_POST['msg_content'];
	$from_user=$_COOKIE['username'];
	// echo $to_user.'|'.$msg_content;	

	// 写入数据表
	$sql = "INSERT INTO message(
							to_user,
							from_user,
							msg_content,
							msg_date
							)
					VALUES (
							'{$to_user}',
							'{$from_user}',
							'{$msg_content}',
							NOW()
							);";

	if(!$result=$_mysqli -> query($sql)){
		echo '错了'.$_mysqli->error;
	}else{
		echo 'ok';
		// _location('blog.php');	
		_alert_back('返回继续查看');
	}
	$_mysqli -> close();

 ?>