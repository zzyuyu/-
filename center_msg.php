<?php 
	require __DIR__.'/includes/common.php';	//引入common

	// 监控网页加载时间，开始时间
	$start_time=_runtime();
	
	// 分离css引入，定义常量PAGE
	define('PAGE', 'center');

	$username=$_COOKIE['username'];
	
	if(isset($username)){
		if(isset($_GET['recvice'])){
			$sql="SELECT * FROM message WHERE to_user='{$username}'";	
		
			$recvice_class="color_red";	
			$send_class="";
			// 设置开关，区分发件人还是收件人
			$flag=true;
		}else{
			$sql="SELECT * FROM message WHERE from_user='{$username}'";

			$recvice_class="";	
			$send_class="color_red";
			$flag=false;
		}
		$th_who=$flag?'发件人':'收件人';
									
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
					<a href="center_msg.php?send=true" class="<?php echo $send_class ?>">已发送</a>
					<a href="center_msg.php?recvice=true" class="<?php echo $recvice_class ?>">已接收</a>
					<table border="1"  border="0" cellspacing="0">
						<thead>
							<th>序号</th><th><?php echo $th_who ?></th><th>内容</th><th>时间</th><th>操作</th>
						</thead>
						<tbody>
							
							<?php 
								$m=1;
								while(!!$row=$result->fetch_assoc()){
									$_td_who=$flag?$row['from_user']:$row['to_user'];
									$_msg_content=$row['msg_content'];
									$_msg_date=$row['msg_date'];
									$_id=$row['id'];
								
									echo "<tr>
											<td>$m</td>
											<td>$_td_who</td>
											<td>$_msg_content</td>
											<td>$_msg_date</td>
											<td>
												<b class='delete'>删除</b>
												<span style='display:none'>$_id</span>
												<input type='checkbox' name='del' class='del'>
											</td>
										</tr>";
									$m++;
								}
							 ?>	
							<tr>
								<td colspan="4" align="right"><label >全选<input type="checkbox" id="check_all"></label></td>
								 <td><span id="del">删除</span></td>						
							</tr>
						</tbody>
					</table>
					
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
 		echo '<script src='.JS_PATH.'/center_msg.js></script>'; 
 		
 	 ?>
 </body>
 </html>