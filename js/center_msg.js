$(function(){
	$('.delete').click(function(){
		var oId=$(this).next().html();
		// $(this).parents('tr').remove();
		var msg_page=location.href.indexOf('recvice');
		if(msg_page!=-1){
			location.href='controllers/get_msg_delete.php?msg_page=recvice&delete=true&id='+oId;
		}else{
			location.href='controllers/get_msg_delete.php?msg_page=send&delete=true&id='+oId;
		}
	})

	$('#check_all').click(function(){
		// 注：此处用jq写，某些版本会出现bug，无法取消全选，所以此处用js方法，此处仔细理解
		var dels=document.getElementsByName('del');
		for(var i=0;i<dels.length;i++){
			dels[i].checked=$(this)[0].checked;	
		}
	})
	$('#del').click(function() {
		var id_arr=[];
		// 此处也是js和jq的对象转换
		$('.del').each(function(){
			if($(this).get(0).checked){
				id_arr.push($(this).prev().html());
			}
		})
		console.log(id_arr);
		var url='./controllers/get_msg_delete.php';
		var data={ids:id_arr};
		$.post(url,data,function(d){
			console.log(d);
			if(d=='ok'){
				window.location.reload();
			}
		});
	});
		
})
