<?php 
	
	require __DIR__.'/includes/common.php';	//引入common

	// 监控网页加载时间，开始时间
	$start_time=_runtime();
	
	// 分离css引入，定义常量PAGE
	define('PAGE', 'article');


	@$username=$_COOKIE['username'];
	if(isset($username)){
		@$_id=$_GET['id'];
		// 帖子信息
		$sql="SELECT * FROM article WHERE id='{$_id}' AND reid=0;";
		$result=$_mysqli->query($sql);
		if(!!$row=$result->fetch_assoc()){
			$_username=$row['username'];	// 主题帖的用户
			$_title=$row['title'];		// 主题帖标题
			$_content=$row['content'];		//主题帖内容
			$_pub_time=$row['pub_time'];	// 主题帖时间
			// 评论人的信息
			if(isset($_username)){
				$sql="SELECT * FROM users WHERE username='{$_username}';";
				$res=$_mysqli->query($sql);
				if(!!$r=$res->fetch_assoc()){
					$_sex=$r['sex'];	// 主题帖用户性别
					$_photo=$r['photo'];	// 主题帖用户头像
					$_email=$r['email'];	// 主题帖用户邮箱
					$_url=$r['url'];	// 主题帖用户主页
				}
			}			
		}else{
			echo '帖子不存在';
			exit();
		}

		// 增加阅读量
		if($username!=$row['username']){
			// echo '可以增加';
			// 叠加阅读量
			$sq = "UPDATE article SET
									read_num=read_num+1	
								WHERE id='{$_id}';";		
			$result=$_mysqli -> query($sq);
			if(!$result){
				_alert_back('sql语句错误！');
				die();
			}else{
				// echo '增加成功！';	
			}
		}
	}else{
		echo '非法登陆！';
	}

	
	

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>北云博客--博友</title>
	<?php 
		require INC_PATH.'/links.inc.php';
	 ?>
</head>
<body>
	
	<div id="warp">
		<?php 
			require INC_PATH.'/header.inc.php';
		 ?>
		<div id="article">
			<h2 class="s-title">博文详情</h2>
			<div class="art_detial clear">
				<div class="art_side left">
					<?php 		
					
							echo '
							<div class="item">
								<p class="name">'.$_username.'('.$_sex.')</p>
								<div><img src="'.$_photo.'" alt="" width="100%"></div>				
								<div class="txt">
									<p class="clear"><span class="left send_msg">发消息</span> <span class="right make_friend">加为好友</span></p>
									<p class="clear"><span class="left">写留言</span> <span class="right send_flower">给TA送花</span></p>
								</div>
								<div>
									<p>邮箱：'.$_email.'</p>
									<p>主页：'.$_url.'</p>
								</div>
							</div>
							';
						
					 ?>
				</div>
				<div class="art_main left">
					<!-- 帖子内容 -->
					<div>
						<p class="clear art_main_top">
							<?php echo $_username ?> | 发表于 <?php echo  $_pub_time ?> 
							<span class="right">1楼</span>
						</p>
						<h3><?php echo $_title ?></h3>
						<p class="art_content">
							<?php echo $_content ?>
						</p>
					</div>
					<!-- 已经有的回复 -->
					<?php 
						// 读取回复  reid必须为当前id
						$sql="SELECT * FROM article WHERE reid='{$_id}' ORDER BY pub_time ASC;";

						$result=$_mysqli->query($sql);
						// echo '<h1>'.$result->num_rows.'</h1>';
						$m=2;	//楼层
						while(!!$row=$result->fetch_assoc()){
							$_name=$row['username'];	//回复者名字

							$_t=$row['title'];	//回复的标题
							$_c=$row['content'];	//回复的内容
							$_p_t=$row['pub_time']; 	// 回复的时间
							$s="SELECT photo FROM users WHERE username='{$_name}';";
							$res=$_mysqli->query($s);
							
							if(!!$r=$res->fetch_assoc()){
								$_p=$r['photo'];	// 回复者头像
								echo '
									<div class="show_reply clear">
										<div class="left">
											<p>'.$_name.'</p>
											<div><img src="'.$_p.'" alt=""></div>
										</div>
										<div class="right">
											<p class="clear art_main_top">
												发表于 '.$_p_t .'
												<span class="right">'.$m.'楼</span>
											</p>
											<h3>'.$_t.' <a href="#re" class="re" data-str="Re@'.$m.'楼的'.$_name.'">回复</a></h3>
											<p class="art_content">
												'. $_c .'
											</p>
										</div>
									</div>
								';
							}
							$m++;
						}
					 ?>
					
				</div>
				
			</div>

			<div class="reply">
				<form action="controllers/get_reply.php" method="post">
					<a name="re"></a>
					<input type="hidden" name="reply" value="true">
					<input type="hidden" name="reid" value="<?php echo $_id ?>">

					<p>标题：<input type="text" name="title" id="re_title" value="Re@<?php echo $_title ?>"></p>
					<textarea name="content" id="reply_txt" cols="30" rows="10"></textarea>
					<p><input type="submit" value="回复"></p>
				</form>
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

	<script src="js/jquery.js"></script>
	<script>
		$(function(){
			$('.re').click(function(){
				var str=$(this).attr('data-str');
				$('#re_title').val(str);
			})
		})
	</script>
</body>
</html>