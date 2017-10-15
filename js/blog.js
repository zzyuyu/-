$(function(){
	$('.send_msg').on('click',function(){
		var to_user=$(this).parent().parent().siblings('.name').html();
		

		var str='<div id="msg_box"><form action="controllers/get_msg.php" method="post"><h2>发送消息</h2><h4>To:'+to_user+'</h4><input type="hidden" name="to_user" value="'+to_user+'"><textarea name="msg_content" id="msg" cols="30" rows="10"></textarea><input type="submit" value="确定" class="sub"><input type="button" id="close" value="取消"></form></div>';
		$('body').append(str);

		var box=$('#msg_box');

		box.css({'left' : ($(window).width() - box.outerWidth())/2 ,'top' : ($(window).height() - box.outerHeight())/2+$(window).scrollTop()  });

		$('#close').on('click',box,function(){	
			box.remove();			
		});
		
		

		$(window).on('resize scroll',function(){		
			box.css('left' , ($(window).width() - box.outerWidth())/2 );
			box.css('top' , ($(window).height() - box.outerHeight())/2 + $(window).scrollTop() );
		});
		
	})
	$('.make_friend').on('click',function(){
		var to_user=$(this).parent().parent().siblings('.name').html();
		

		var str='<div id="fri_box"><form action="controllers/get_friend.php" method="post"><h2>加为好友</h2><h4>To:'+to_user+'</h4><input type="hidden" name="to_user" value="'+to_user+'"><textarea name="code_msg" id="msg" cols="30" rows="10">交个朋友吧！</textarea><input type="submit" value="确定" class="sub"><input type="button" id="close" value="取消"></form></div>';
		$('body').append(str);

		var box=$('#fri_box');

		box.css({'left' : ($(window).width() - box.outerWidth())/2 ,'top' : ($(window).height() - box.outerHeight())/2+$(window).scrollTop()  });

		$('#close').on('click',box,function(){	
			box.remove();			
		});
		
		

		$(window).on('resize scroll',function(){		
			box.css('left' , ($(window).width() - box.outerWidth())/2 );
			box.css('top' , ($(window).height() - box.outerHeight())/2 + $(window).scrollTop() );
		});
		
	})
	$('.send_flower').on('click',function(){

		var to_user=$(this).parent().parent().siblings('.name').html();
		

		var str='<div id="flower_box"><form action="controllers/get_flowers.php" method="post"><h2>送花</h2><h4>To:'+to_user+'</h4><input type="hidden" name="to_user" value="'+to_user+'" /> 个数:<input type="number" name="num" value="1" min="1" /> <textarea name="words" id="msg" cols="30" rows="10">你好漂亮，请接收我的鲜花！</textarea> <input type="submit" value="确定" class="sub"><input type="button" id="close" value="取消"></form></div>';
		$('body').append(str);

		var box=$('#flower_box');

		box.css({'left' : ($(window).width() - box.outerWidth())/2 ,'top' : ($(window).height() - box.outerHeight())/2+$(window).scrollTop()  });

		$('#close').on('click',box,function(){	
			box.remove();			
		});
		
		

		$(window).on('resize scroll',function(){		
			box.css('left' , ($(window).width() - box.outerWidth())/2 );
			box.css('top' , ($(window).height() - box.outerHeight())/2 + $(window).scrollTop() );
		});
		
	})
})