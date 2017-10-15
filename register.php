<?php 
	require __DIR__.'/includes/common.php';	//引入common
	// 监控网页加载时间，开始时间
	$start_time=_runtime();

	// 分离css引入，定义常量PAGE
	define('PAGE', 'register');
	
	// 设置唯一标识符，主要用于用户登陆和防止恶意调用
	session_start();

	// uniqid() 方法会产生一个几乎是世界上唯一的字符串，这个叫做唯一标识符，其他地方也可能会用，把它封装成函数放到核心函数库(globals)
	// $_SESSION['uniqid']=$uniqid=sha1(uniqid(mt_rand(),true));
	$_SESSION['uniqid']=$uniqid=_get_uniqid();
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>北云博客--注册</title>
	<?php require INC_PATH.'/links.inc.php' ?>
 </head>
 <body>
 	<div id="warp">
 		<?php 
			require INC_PATH.'/header.inc.php';
		 ?>
		<div id="reg-main">
			<h2 class="s-title">欢迎注册</h2>
			<form action="controllers/get_reg.php" method="post" id="reg-form" enctype="multipart/form-data">
				<h3>欢迎加入北云博客</h3>
				<!-- 用于防止恶意调用 -->
				<input type="hidden" name="regform" value="true">
				<!-- 用于用户登陆的唯一标识符，也用于防止恶意调用 -->
				<input type="hidden" name="uniqid" value="<?php echo $uniqid ?>">
				<div>用 户 名：<input type="text" name="username" class=""></div>
				<div>密&nbsp;&nbsp;码：<input type="password" name="password" class=""></div>
				<div>确认密码：<input type="text" name="repassword" class=""></div>
				<div>
					性&nbsp;&nbsp;别：
					<input type="radio" name="sex" value="男" checked>男
					<input type="radio" name="sex" value="女" >女
				</div>
				<div class="photo">
					头&nbsp;&nbsp;像:
					<img src="photos/p01.jpg" alt="" id="sphoto">
					<span>点击更换</span>
					<input type="hidden" name="photo" value="photos/p01.jpg" id="photo">

				</div>
				<div>
					电子邮件：
					<input type="text" name="email">
				</div>
				<div>
					手 机 号:
					<input type="text" name="tel">
				</div>
				<div>
					个人网站：
					<input type="text" name="url" value="http://">
				</div>
				<div id="code_box">
					验 证 码：
					<input type="text" name="yzm" class="yzm">
					<img src="code.php" title="点击更换" id="scode">
				</div>
				<div class="sub-box">
					<input type="submit" id="regSub" value="加入">
				</div>
			</form>
		</div>
		
		<?php 			
			require INC_PATH.'/footer.inc.php';
		 ?>
 	</div>
 	
 		<?php 
 			echo '<script src='.JS_PATH.'/jquery.js></script>'; 
 			echo '<script src='.JS_PATH.'/reg.js></script>'; 
 					
 			// 监控网页加载时间，开始时间
			$end_time=_runtime();
			$_runtime=$end_time-$start_time;

			// 引入加载时间div
			require INC_PATH.'/runtime.inc.php';		

 		?> 		
 </body>
 </html>
