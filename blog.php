<?php 
	
	require __DIR__.'/includes/common.php';	//引入common

	// 监控网页加载时间，开始时间
	$start_time=_runtime();
	
	// 分离css引入，定义常量PAGE
	define('PAGE', 'blog');

	// 从数据库获取数据
	// $sql="SELECT username,photo FROM users LIMIT 0,10";
	
	// 容错处理，防止变态程序员用户
	// 1.没有page传入 2.page等于空 3.page小于0 4.page不是数字 5.page等于小数
	if(isset($_GET['page'])){
		$pagenum=$_GET['page'];
		if(empty($pagenum) || $pagenum<=0 || !is_numeric($pagenum)){
			$pagenum=1;
		}else{
			$pagenum=intval($pagenum);
		}
	}else{
		$pagenum=1;
	}
	$pagesize=6;
	$pagestart=($pagenum-1)*$pagesize;

	@$username=$_COOKIE['username'];
	if(isset($username)){
		$sql="SELECT username,photo,id FROM users WHERE username!='{$username}' LIMIT $pagestart,$pagesize ";
	}else{
		$sql="SELECT username,photo,id FROM users LIMIT $pagestart,$pagesize ";
	}
	
	$result=$_mysqli->query($sql);
	// 获取总页数，根据总页数来设置页码
	$s="SELECT id FROM users WHERE username!='{$username}';";	//获取一共多少条数据
	$_mysqli->query($s);
	$len=$_mysqli->affected_rows;
	if($len==0){
		$len=1;
	}elseif($pagenum>$len){
			$pagenum=$len;
	}else{
		$len=ceil($len/$pagesize);	
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
		<div id="blog">
			<h2 class="s-title">推荐博友</h2>
			<div id="friend_box" class="clear">
				<?php 
					while (!!$row=$result->fetch_assoc()) {
						echo '
						<div class="item">
							<p class="name">'.$row["username"].'</p>
							<div><img src="'.$row["photo"].'" alt="" width="100%"></div>
							<div class="txt">
								<p class="clear"><span class="left send_msg">发消息</span> <span class="right make_friend">加为好友</span></p>
								<p class="clear"><span class="left">写留言</span> <span class="right send_flower">给TA送花</span></p>
							</div>
						</div>
						';
					}
				 ?>
			</div>
			
			<ul class="page">
				<?php 
					for($i=0;$i<$len;$i++){
						echo '<li><a href="blog.php?page='.($i+1).'">'.($i+1).'</a></li>';
					}
				 ?>
			</ul>
			<ul class="page">
				<li><?php echo $pagenum .'/'. $len ?>页</li>
				<?php 
					if($pagenum==1){
						// echo '<li class="color_red">首页</li>';
						// echo "\n";
						echo '<li><a href="blog.php?page='.($pagenum+1).'">下一页</a></li>';
						echo "\n";
						echo '<li><a href="blog.php?page='.$len.'">尾页</a></li>';
					}elseif($pagenum==$len){
						echo '<li><a  href="blog.php">首页</a></li>';
						echo "\n";
						echo '<li><a href="blog.php?page='.($pagenum-1).'">上一页</a></li>';
					}else{
						echo '<li><a  href="blog.php">首页</a></li>';
						echo "\n";
						echo '<li><a href="blog.php?page='.($pagenum-1).'">上一页</a></li>';
						echo "\n";
						echo '<li><a href="blog.php?page='.($pagenum+1).'">下一页</a></li>';
						echo "\n";
						echo '<li><a href="blog.php?page='.$len.'">尾页</></li>';
					}
				 ?>
			</ul>
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
		echo '<script src='.JS_PATH.'/blog.js></script>'; 
	?> 	
</body>
</html>