<?php 
	setcookie('username','',time()-3600,'/php/blog-1.1');
	require '../includes/common.php';	//引入common
	
	_location('index.php');
 ?>