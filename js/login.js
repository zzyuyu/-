$(function(){
	$('#scode').on('click',reget_code);
	$('.yzm').on('keyup',valid);
	
})

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
