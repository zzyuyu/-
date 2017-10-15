<?php 
	
	require __DIR__.'/includes/common.php';	//引入common

	// 监控网页加载时间，开始时间
	$start_time=_runtime();
	
	// 分离css引入，定义常量PAGE
	define('PAGE', 'login');

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>北云博客--登陆</title>
	<?php 
		require INC_PATH.'/links.inc.php';
	 ?>
</head>
<body>
	<div id="warp">
		<?php 
			require INC_PATH.'/header.inc.php';
		 ?>
		<div id="login">
			<h2 class="s-title">欢迎登陆</h2>
			<form action="controllers/get_login.php" method="post" id="login_form" enctype="multipart/form-data">
				<h3>欢迎登陆北云博客</h3>
				<!-- 用于防止恶意调用 -->
				<input type="hidden" name="loginform" value="true">
				
				<div>用 户 名：<input type="text" name="username" id="username" autocomplete="off"></div>
				<div>密&nbsp;&nbsp;码：<input type="password" name="password" class="" autocomplete="off"></div>
				
				<div id="code_box">
					验 证 码：
					<input type="text" name="yzm" class="yzm">
					<img src="code.php" title="点击更换" id="scode">
				</div>
				<div class="sub-box">
					<input type="submit" id="loginSub" value="登陆">
				</div>
			</form>
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