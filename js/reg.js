$(function(){

	$('#sphoto').on('click',append);
	$('.yzm').on('keyup',valid);
	$('#scode').on('click',reget_code);

	
	// 应该进行其他验证，都通过后才可以提交
})

function append(){

	var arr=[1,2,3,4,5,6,7,8,9];
	var str='<div id="picBox">';
	for(var i=0;i<arr.length;i++){
		str+='<img src="photos/p0'+arr[i]+'.jpg" />';
	}
	str+='<div id="local-btns"><input type="file" id="file" /> <span id="fileText">选择本地图片</span> </div>'
	str+='<div id="pic-btns"><button id="sure">确定</button><button id="close">取消</button></div>';
	str+='</div>';
	$('body').append(str);

	var box=$('#picBox');

	box.css({'left' : ($(window).width() - box.outerWidth())/2 ,'top' : ($(window).height() - box.outerHeight())/2+$(window).scrollTop()  });

	$('#close').on('click',box,function(){	
		box.remove();			
	});
	
	$('#picBox>img').on('click',box,function(){
		$(this).addClass('active').siblings().removeClass('active');
	})

	$('#sure').on('click',box,function(){		
		var s=$('#picBox').find('.active').attr('src');
		$('#sphoto').attr('src',s);
		$('#photo').val(s);
		console.log($('#photo').val());
		box.remove();		
		
	})

	$(window).on('resize scroll',function(){		
		box.css('left' , ($(window).width() - box.outerWidth())/2 );
		box.css('top' , ($(window).height() - box.outerHeight())/2 + $(window).scrollTop() );
	});
}

function valid(){
	// 只做验证码，其他验证此处省略
	
	$.get('js_get_code.php',function(data){	
		console.log(data,$('.yzm').val())
		if(data==$('.yzm').val()){
			$('.yzm').css('borderColor','green');
		}else{
			$('.yzm').css('borderColor','red');
		}		
	})	
}

function reget_code(){
	var timestrap=new Date().getTime();
	$('#scode').attr('src','code.php');
}

