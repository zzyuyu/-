<?php 
	
	require __DIR__.'/includes/common.php';	//引入common

	// 监控网页加载时间，开始时间
	$start_time=_runtime();
	
	// 分离css引入，定义常量PAGE
	define('PAGE', 'index');
	
	// 最新会员
	if(isset($_COOKIE['username'])){
		$sql="SELECT username,photo,sex FROM users WHERE username!='{$_COOKIE['username']}' ORDER BY reg_time DESC LIMIT 0,6;";
	}else{
		$sql="SELECT username,photo,sex FROM users ORDER BY reg_time DESC LIMIT 0,6;";
	}
	$result=$_mysqli->query($sql);
	

	

	// 帖子分页
	$pagesize=10;
	$s="SELECT id FROM article WHERE reid=0";	//获取一共多少条数据
	$_mysqli->query($s);
	$len=$_mysqli->affected_rows;
	if($len==0){
		$len=1;
	}else{
		$len=ceil($len/$pagesize);	
	}
	// 获取总页数，根据总页数来设置页码
	if(isset($_GET['page'])){
		$pagenum=$_GET['page'];
		if(empty($pagenum) || $pagenum<=0 || !is_numeric($pagenum)){
			$pagenum=1;
		}elseif($pagenum>$len){
			$pagenum=$len;
		}else{
			$pagenum=intval($pagenum);
		}
	}else{
		$pagenum=1;
	}
	
	$pagestart=($pagenum-1)*$pagesize;
	// 帖子列表	
	$sql="SELECT * FROM article WHERE reid=0 ORDER BY pub_time DESC LIMIT $pagestart,$pagesize ;";
	$res=$_mysqli->query($sql);
	
	

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>北云博客--首页</title>
	<?php 
		require INC_PATH.'/links.inc.php';
	 ?>
	
</head>
<body>
	<div id="warp">
		<?php 
			require INC_PATH.'/header.inc.php';
		 ?>
		

		<div id="list">
			<h2 class="s-title clear">最新热帖 <small class="right"><a href="publish.php">发表帖子</a></small></h2>
			<ul>
				<?php 
					while(!!$row=$res->fetch_assoc()){
						$_title=$row['title'];
						$_read_num=$row['read_num'];
						$_pl_num=$row['pl_num'];
						$_pub_time=$row['pub_time'];
						$_id=$row['id'];
						$_username=$row['username'];
						echo '
						<li class="clear">
							<h4 class="left"><a href="article.php?id='.$_id.'">'.$_title.'</a><small>'.$_username.'</small></h4>
							<p class="right">
								<span>'.$_pub_time.'</span>
								<span>阅读数('.$_read_num.')</span>
								<span>评论数('.$_pl_num.')</span>
							</p>
						</li>
						';
					}
				 ?>
				<!-- <li class="clear">
					<h4 class="left"><a href="article.php?id">asdfasf</a></h4>
					<p class="right">
						<span>阅读数(12)</span>
						<span>评论数(5)</span>
					</p>
				</li> -->
			</ul>
			<ul class="page">
				<li><?php echo $pagenum .'/'. $len ?>页</li>
				<?php 
					if($pagenum==1){
						// echo '<li class="color_red">首页</li>';
						// echo "\n";
						echo '<li><a href="index.php?page='.($pagenum+1).'">下一页</a></li>';
						echo "\n";
						echo '<li><a href="index.php?page='.$len.'">尾页</a></li>';
					}elseif($pagenum==$len){
						echo '<li><a  href="index.php">首页</a></li>';
						echo "\n";
						echo '<li><a href="index.php?page='.($pagenum-1).'">上一页</a></li>';
					}else{
						echo '<li><a  href="index.php">首页</a></li>';
						echo "\n";
						echo '<li><a href="index.php?page='.($pagenum-1).'">上一页</a></li>';
						echo "\n";
						echo '<li><a href="index.php?page='.($pagenum+1).'">下一页</a></li>';
						echo "\n";
						echo '<li><a href="index.php?page='.$len.'">尾页</></li>';
					}
				 ?>
			</ul>
		</div>
		<div id="user">
			<h2 class="s-title">新进会员</h2>
			<ul>
				<!-- <li>
					<a href="">
						<p>孙国元（男）</p>
						<div>
							<img src="photos/p01.jpg" alt="">
						</div>
					</a>
				</li> -->
				<?php 			
					
					while(!!$row=$result->fetch_assoc()){
						$_username=$row['username'];
						$_photo=$row['photo'];
						$_sex=$row['sex'];
						
						echo '<li><a href="javascript:;"><p>'.$_username.'('.$_sex.')</p><div><img src="'.$_photo.'"/></div></a></li>';
					
					}
				 ?>	
			</ul>
		</div>
		<div id="pics">
			<h2 class="s-title">我拍你说</h2>
		</div>
		<div class="clear"></div>
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
