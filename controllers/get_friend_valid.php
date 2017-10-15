<?php 
	require '../includes/common.php';	//引入common


	$_id=$_GET['id'];
	$_state=$_GET['valid'];

	if($_state){
		$sql = "UPDATE friend SET
							state=1
						WHERE id='{$_id}';";
	
		$result=$_mysqli -> query($sql);
		if(!$result){
			_alert_back('sql语句错误！');
			die();
		}else{
			echo '成功！';
			$_mysqli -> close();
			_location('center_friend.php');		
		}
	}
	
 ?>