<?php 

	require '../includes/common.php';	//引入common

	if(isset($_POST['reply'])){
		$_reid=$_POST['reid'];
		$_title=$_POST['title'];
		$_content=$_POST['content'];
		$username=$_COOKIE['username'];

		// 写入
		$sql = "INSERT INTO article(
										reid,
										username,
										title,
										content,
										pub_time
										)
								VALUES (
										'{$_reid}',
										'{$username}',
										'{$_title}',
										'{$_content}',					
										NOW()									
										);";

			
		if(!$_mysqli -> query($sql)){
			echo '错了'.$_mysqli->error;
		}else{
			echo '回复成功！';

			_location('article.php?id='.$_reid);
		}
		
		
	}
		

 ?>