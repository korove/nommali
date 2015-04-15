<?php  
	// echo 'Add job 555';
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	require_once("{$base_dir}database{$ds}conDb.php");
	require_once("{$base_dir}include{$ds}function.php");

	$err = "test4";
	$successMsg = "";
	$arrOut = array('err'=>'','successMsg'=>'');

	$jobName = "";
	$jobDetail = "";
	$jobAmount = "";
	$jobActive = "Y";

	if(!isset($_POST['jobNameAdd']) || empty($_POST['jobNameAdd'])){
		$err .= "<li>กรุณากรอก 'ชื่อตำแหน่ง'</li>";
	}
	if(!isset($_POST['jobDetailAdd']) || empty($_POST['jobDetailAdd'])){
		$err .= "<li>กรุณากรอก 'รายละเอียดงาน'</li>";
	}
	if(!isset($_POST['jobAmountAdd']) || empty($_POST['jobAmountAdd'])){
		$err .= "<li>กรุณากรอก 'จำนวนที่รับ'</li>";
	}

	if(!empty($err)){
		$arrOut['err'] = "<ul>". $err ."</ul>";
	}else{
		$jobName = "";
		$jobDetail = "";
		$jobAmount = "";
		$jobActive = "Y";
	}
	
	// echo $err;
	echo json_encode($arrOut);
?>