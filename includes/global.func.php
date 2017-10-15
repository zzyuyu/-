<?php 
	// 存放全局方法

	/*
		1._runtime() 用来获取执行时间
			@access public 表示函数对外开放
			@return float  表示函数返回的是浮点数类型
		2._get_uniqid() 用来设置唯一标识符
			@access public 
			@return string
		3._location() 用来跳转页面
			@access public
			@return null
			@argument url
	*/
	
	function _runtime(){
		$mic_time = explode(' ', microtime());
		return $mic_time[1]+$mic_time[0];
	}
	function _get_uniqid(){
		return sha1(uniqid(mt_rand(),true));
	}
	function _location($url){
		header("Location:../$url");
	}
	function _alert_back($str){
		// echo "<h1>{$str}</h1><script>history.back();</script>";
		echo "<script>if(confirm('{$str}')){history.back();}</script>";
		
	}
	function _back(){
		echo "<script>history.back();</script>";
	}
 ?>
