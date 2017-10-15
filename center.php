<?php 
	require __DIR__.'/includes/common.php';	//引入common

	// 监控网页加载时间，开始时间
	$start_time=_runtime();
	
	// 分离css引入，定义常量PAGE
	define('PAGE', 'center');

	if(isset($_COOKIE['username'])){
		$sql="SELECT * FROM users WHERE username='{$_COOKIE['username']}'";
		$result=$_mysqli->query($sql);
		$row=$result->fetch_assoc();
		$_username=$row['username'];
		$_sex=$row['sex'];
		$_photo=$row['photo'];
		$_email=$row['email'];
		$_url=$row['url'];
		$_tel=$row['tel'];
		$_reg_time=$row['reg_time'];
	}else{
		echo '非法进入！';
	}
	
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>个人中心</title>
 	<?php require INC_PATH.'/links.inc.php'; ?>
 </head>
 <body>
 	<div id="warp">
 		<?php 
			require INC_PATH.'/header.inc.php';
		 ?>
		<div id="center" class="clear">
			<div class="center_side">
				<h2 class="s-title">会员导航</h2>
				<div class="side_nav">
					<ul class="nav_list">
						<li>账号管理</li>
						<li><a href="center.php">个人信息</a></li>
						<li><a href="center_editor.php">修改资料</a></li>
					</ul>
					<ul class="nav_list">
						<li>账号管理</li>
						<li><a href="center_msg.php">短息查询</a></li>
						<li><a href="center_friend.php">好友设置</a></li>
						<li><a href="center_flowers.php">查询鲜花</a></li>
						<li><a href="">个人相册</a></li>
					</ul>
				</div>
			</div>
			<div class="center_main">
				<h2 class="s-title">会员管理</h2>
				<div class="main_box">
					<?php 
						echo 
						'
							<ul>
								<li>用户名：'.$_username.'</li>
								<li>性别：'.$_sex.'</li>
								<li>头像：<img src="'.$_photo.'" alt=""></li>
								<li>电子邮件：'.$_email.'</li>
								<li>个人主页：'.$_url.'</li>
								<li>手机号：'.$_tel.'</li>
								<li>注册时间：'.$_reg_time.'</li>
							</ul>
						';
					 ?>
					 <a href="center_editor.php" id="editor">编辑</a>
				</div>
			</div>
		</div>
		 <?php 
			require INC_PATH.'/footer.inc.php';
		 ?>

 	</div>
 	<?php 
 		// 监控网页加载时间，开始时间
		$end_time=_runtime();
		$_runtime=$end_time-$start_time;
		// 引入加载时间div
		require INC_PATH.'/runtime.inc.php';
 	 ?>
 </body>
 </html>