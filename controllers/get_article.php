<?php 
	require '../includes/common.php';	//引入common

	if(isset($_POST['article'])){
		$_username=$_COOKIE['username'];
		$_title=$_POST['title'];
		$_content=$_POST['content'];

		// 应该判断标题是否存在，省略
		
		// 写入数据表
		$sql = "INSERT INTO article(
								username,
								title,
								content,
								pub_time								
								)
						VALUES (
								'{$_username}',
								'{$_title}',
								'{$_content}',
								NOW()
								);";

		if(!$result=$_mysqli -> query($sql)){
			echo '错了'.$_mysqli->error;
		}else{
			echo 'ok';
			$sql = "SELECT id FROM article WHERE title='{$_title}';";
			$result=$_mysqli->query($sql);
			
			$row=$result->fetch_assoc();
			$_id=$row['id'];
			// echo $_id;
			_location('article.php?id='.$_id);			
		}
		$_mysqli -> close();
	}else{
		echo '非法进入';
	}
 ?>