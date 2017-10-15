<?php 
	require __DIR__.'/includes/common.php';	//引入common

	// 监控网页加载时间，开始时间
	$start_time=_runtime();
	
	// 分离css引入，定义常量PAGE
	define('PAGE', 'center');	

	
	$username=$_COOKIE['username'];
	if(isset($username)){
		$sql="SELECT * FROM flowers WHERE to_user='{$username}' ORDER BY date DESC;";
		$result=$_mysqli->query($sql);
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
				
					<table border="1"  border="0" cellspacing="0">
						<thead>
							<th>序号</th><th>送花好友</th><th>好友感言</th><th>时间</th><th>数量</th><th>操作</th>
						</thead>
						<tbody>
							
							<?php 
								$m=1;
								$_all_num=0;
								while(!!$row=$result->fetch_assoc()){
									$_words=$row['words'];
									$_date=$row['date'];
									$_id=$row['id'];
									$_to_user=$row['to_user'];
									$_from_user=$row['from_user'];
									$_num=$row['num'];
									$_all_num+=$_num;
									if($username==$_to_user){
										$_friend=$_from_user;										
									}elseif($username==$_from_user){
										$_friend=$_to_user;										
									}

									echo "<tr><td>$m</td><td>$_friend</td><td>$_words</td><td>$_date</td><td>$_num</td><td><b class='delete'>删除</b><span style='display:none'>$_id</span><input type='checkbox' name='del' class='del'></td></tr>";
									$m++;
								}
							 ?>	
							<tr><td colspan="6">共收到鲜花：<?php echo $_all_num ?>朵</td></tr>
							<tr>
								<td colspan="5" align="right"><label >全选<input type="checkbox" id="check_all"></label></td>
								 <td><span id="del">删除</span></td>						
							</tr>
						</tbody>
					</table>
					<h4>删除不做，自己处理</h4>
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

		echo '<script src='.JS_PATH.'/jquery.js></script>'; 
 		
 	 ?>
 </body>
 </html>