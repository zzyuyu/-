<?php 
	define('COPY',true);	//防止恶意调用
	define('INC_PATH',__DIR__);	//设置根路径，后面引入会比相对路径速度块
	define('JS_PATH','./js');


	// 引入全局函数库 global.func.php
	require INC_PATH.'/global.func.php';
	

	// 链接数据库
	header('Content-Type:text/html;charset=utf8');
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_NAME','users');
	define('DB_PWD','');
	// 创建数据库链接
	$_mysqli = @new mysqli('localhost','root','','blog');
	if($_mysqli->connect_errno){
		
		die('链接错误！错误码是：'.$_mysqli->connect_errno.'错误信息是：'.$_mysqli->connect_error);	// 输出并退出脚本
	}
	$_mysqli->set_charset('utf8');

 ?>