<?php 
	require '../includes/common.php';	//引入common

	if(isset($_GET['delete'])){
		$_id=$_GET['id'];		

		$sql="DELETE FROM message WHERE id='{$_id}'";	
		$result=$_mysqli->query($sql);
		if($result){
			$msg_page=$_GET['msg_page'];
			$url="center_msg.php?{$msg_page}=true";
			_location($url);
		}else{
			_alert_back('删除失败！');
		}			
	}
	if(isset($_POST['ids'])){
		$id_arr=$_POST['ids'];
		print_r($id_arr);
		$id_str=implode(',',$id_arr);
		$sql="DELETE FROM message WHERE id IN ({$id_str});";	//小括号放字符串
		$result=$_mysqli->query($sql);
		if($result){
			echo 'ok';
		}else{
			echo 'cuole ';
		}
	}
 ?>