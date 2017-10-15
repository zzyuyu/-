<?php 
	require __DIR__.'/includes/common.php';	//引入common

	// 监控网页加载时间，开始时间
	$start_time=_runtime();
	
	// 分离css引入，定义常量PAGE
	define('PAGE', 'center');

	

	
	$username=$_COOKIE['username'];
	if(isset($username)){
		$sql="SELECT * FROM friend WHERE to_user='{$username}'  OR from_user='{$username}' ORDER BY date DESC;";
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
							<th>序号</th><th>好友</th><th>内容</th><th>时间</th><th>状态</th><th>操作</th>
						</thead>
						<tbody>
							
							<?php 
								$m=1;
								while(!!$row=$result->fetch_assoc()){
									$_code_msg=$row['code_msg'];
									$_date=$row['date'];
									$_id=$row['id'];
									$_state=$row['state'];
									$_to_user=$row['to_user'];
									$_from_user=$row['from_user'];

									if($username==$_to_user){
										$_friend=$_from_user;
										if($_state==0){
											$_state_txt='<a href="controllers/get_friend.php?action=check&id='.$_id.'" title="点击验证" class="color_red">你未验证</a>';
										}elseif($_state==1){
											$_state_txt='已通过验证';
										}
									}elseif($username==$_from_user){
										$_friend=$_to_user;	
										if($_state==0){
											$_state_txt='对方未验证';
										}elseif($_state==1){
											$_state_txt='已通过验证';
										}									
									}

									echo "<tr><td>$m</td><td>$_friend</td><td>$_code_msg</td><td>$_date</td><td class='valid'>$_state_txt</td><td><b class='delete'>删除</b><span style='display:none'>$_id</span><input type='checkbox' name='del' class='del'></td></tr>";
									$m++;
								}
							 ?>	
							<tr>
								<td colspan="4" align="right"><label >全选<input type="checkbox" id="check_all"></label></td>
								 <td><span id="del">删除</span></td>						
							</tr>
						</tbody>
					</table>
					<h3>删除不做了，和删除信息一样</h3>
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