<?php 
	session_start();
	$code='';
	$rand_code_len=4;
	for($i=0;$i<$rand_code_len;$i++){
		$code.=dechex(mt_rand(0,15));
	}
	$_SESSION['code']=$code;
	// sessino可以通过下标来获取字符串中的字符
	/*echo $_SESSION['code'];
	echo '<br>';
	echo $_SESSION['code'][0].$_SESSION['code'][1].$_SESSION['code'][2]. $_SESSION['code'][3];  //先将最后三行关闭，再输出*/
	

	
	$w=75;
	$h=25;
	$img=imagecreatetruecolor($w, $h);
	
	$fff=imagecolorallocate($img, 255, 255, 255);
	$black=imagecolorallocate($img, 100, 100, 100);
	imagefill($img, 0, 0, $fff);

	// 画边框
	// imagerectangle($img, 0, 0, $w-1, $h-1, $black);

	// 随机画出6个线条
	for($i=0;$i<6;$i++){
		$colors=imagecolorallocate($img, mt_rand(100,255), mt_rand(100,255), mt_rand(100,255));
		imageline($img, mt_rand(0,$w), mt_rand(0,$h),mt_rand(0,$w), mt_rand(0,$h) ,$colors);
	}

	// 随机雪花
	for($i=0;$i<6;$i++){
		$colors=imagecolorallocate($img, mt_rand(100,200), mt_rand(100,200), mt_rand(100,200));
		imagestring($img, 1, mt_rand(1,$w), mt_rand(1,$h),'*',$colors);
	}

	// 验证码
	for($i=0;$i<$rand_code_len;$i++){
		$colors=imagecolorallocate($img, mt_rand(0,150), mt_rand(0,150), mt_rand(0,150));
		imagestring($img, 5, $i*$w/$rand_code_len+mt_rand(1,10), mt_rand(1,$h/2), $_SESSION['code'][$i], $colors);
		// 此处注意验证码的每个字符的位置，x轴和y轴
	}

	
	header('Content-Type:image/png');
	imagepng($img);
	imagedestroy($img);


 ?>