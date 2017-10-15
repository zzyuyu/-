<?php 
	require __DIR__.'/includes/common.php';	//引入common
	define('PAGE','publish');

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>北云博客--发表帖子</title>
 	<?php 
		require INC_PATH.'/links.inc.php';
	 ?>
 </head>
 <body>
 	<div id="warp">
 		<?php 
			require INC_PATH.'/header.inc.php';
		 ?>
		
 		<form action="controllers/get_article.php" method="post" style="width:60%;margin:40px auto;">
 			<h4 class="color_red"></h4>
 			<input type="hidden" name="article" value="true">
	 		<div><strong>标题：</strong> <input type="text" name="title"></div>
			<div>
				<strong>内容：</strong><textarea name="content" id="txt" cols="30" rows="10"></textarea>
			</div>
			<div>
				<input type="submit" id="sub" value="发表">
				<a href="register.php" class="to_login">去登陆</a>
			</div>
	 	</form>
	 	<div class="clear"></div>
		<?php 
			require INC_PATH.'/footer.inc.php';
		 ?>	
		
 	</div>
 	<script src="js/jquery.js"></script>
 	<script>
 		$(function(){
 			var usernmae=getCookie('username');
 			if(!usernmae){
 				$('.color_red').html('您没有登陆！');
 				$('.to_login').show();
 				$('#sub').attr('disabled','true');
 			}
 		})


 		//写cookies 
		function setCookie(name,value) 
		{ 
		    var Days = 30; 
		    var exp = new Date(); 
		    exp.setTime(exp.getTime() + Days*24*60*60*1000); 
		    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
		} 

		//读取cookies 
		function getCookie(name) 
		{ 
		    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
		 
		    if(arr=document.cookie.match(reg))
		 
		        return unescape(arr[2]); 
		    else 
		        return null; 
		}
 	</script>
 </body>
 </html>