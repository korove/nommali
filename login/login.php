<?php 
	// sleep(2);
	$user = "sdf";
	$pswd = "wer";
	$msg = "";
	$msgWelcome = "";

	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	require_once("{$base_dir}include{$ds}function.php");

	$arrOut = array('msg'=>'','msgWelcome'=>'');

	$userLogin = "";
	$password = "";
	if(isset($_POST['userLogin'])){
		$userLogin = validateInputData($_POST['userLogin']);
	}

	if(isset($_POST['password'])){
		$password = validateInputData($_POST['password']);
	}

	if(empty($userLogin)){
		$msg = "กรุณากรอก 'User Name'<br/>";
	}else if(empty($password)){
		$msg = "กรุณากรอก 'Password'<br/>";
	}else{
		if(($userLogin !== $user) && ($password !== $pswd)){
			$msg = "กรุณากรอก 'User Name' หรือ 'Password' ให้ถูกต้อง";
		}else{
			session_start();
			$_SESSION['sess_admin'] = $userLogin;
			$msg = "เข้าสู่ระบบสำเร็จ";
			$msgWelcome = "ยินดีต้อนรับคุณ {$_SESSION['sess_admin']}";
		}
	}

	if(!empty($msg)){
		$arrOut['msg'] = $msg;
	}
	if(!empty($msg)){
		$arrOut['msgWelcome'] = $msgWelcome;
	}

	// echo 'test';
	echo json_encode($arrOut);
?>