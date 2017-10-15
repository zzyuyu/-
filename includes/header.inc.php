<?php 
	if(!defined('COPY')){		// defined 判断常量是否存在
		die('Not Allowed!!!');
	}

	// echo $_COOKIE['username'];	
 ?>
<div id="header">
	<h1>欢迎光临</h1>
	<ul>
		<li><a href="index.php">首页</a></li>
		<?php 

			if(!!@$_COOKIE['username']){
				echo '<li><a href="center.php">'.$_COOKIE['username'].'●个人中心</a></li>';
			}else{
				echo '<li><a href="register.php">注册</a></li>';
				echo "\n";
				echo "\t\t";		// table键，源码好看
				echo '<li><a href="login.php">登陆</a></li>';
			}
		 ?>
		
		<li><a href="blog.php">博友</a></li>
		<li><a href="#">风格</a></li>
		<li><a href="#">管理</a></li>
		<?php 
			if(!!@$_COOKIE['username']){
				echo '<li><a href="controllers/get_logout.php">退出</a></li>';
				echo "\n";
			}
		 ?>
	</ul>
</div>