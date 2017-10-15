<?php 
	require '../includes/common.php';	//引入common
	
	// 设置防止恶意调用和确定是否从写留言的表单提交的，此处省略

	
	$to_user=$_POST['to_user'];
	$words=$_POST['words'];
	$from_user=$_COOKIE['username'];
	$num=$_POST['num'];
	// echo $to_user.'|'.$words;	

	
	// 写入数据表
	$sql = "INSERT INTO flowers(
							to_user,
							from_user,
							num,
							words,
							date
							)
					VALUES (
							'{$to_user}',
							'{$from_user}',
							'{$num}',
							'{$words}',
							NOW()
							);";

	if(!$result=$_mysqli -> query($sql)){
		echo '错了'.$_mysqli->error;
	}else{
		echo 'ok';
		_alert_back('送花成功，返回继续查看');
	}
	$_mysqli -> close();

 ?>