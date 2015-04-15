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

	// $arrOut['err'] = "" == false ? 'Yes' : 'No';
	// $arrOut['err'] = empty($_POST['xcv']) ? 'empty' : 'Not empty';

	$jobName = "";
	$jobDetail = "";
	$jobAmount = "";
	$jobActive = "Y";

	if(empty($_POST['jobNameAdd'])){
		$err .= "<li>กรุณากรอก 'ชื่อตำแหน่ง'</li>";
	}else{
		$jobName = validateInputData($_POST['jobNameAdd']);
		if(empty($jobName)){
			$err .= "<li>กรุณากรอก 'ชื่อตำแหน่ง'</li>";
		}
	}

	if(empty($_POST['jobDetailAdd'])){
		$err .= "<li>กรุณากรอก 'รายละเอียดงาน'</li>";
	}else{
		$jobDetail = validateInputData($_POST['jobDetailAdd']);
		if(empty($jobDetail)){
			$err .= "<li>กรุณากรอก 'รายละเอียดงาน'</li>";
		}
	}

	if(empty($_POST['jobAmountAdd'])){
		$err .= "<li>กรุณากรอก 'จำนวนที่รับ'</li>";
	}else{
		$jobAmount = validateInputData($_POST['jobAmountAdd']);
		if(empty($jobAmount)){
			$err .= "<li>กรุณากรอก 'จำนวนที่รับ'</li>";
		}
	}

	if(!empty($err)){
		$arrOut['err'] = "<ul>". $err ."</ul>";
	}else{
		// No Error

		if(empty($_POST['jobActiveAdd'])){
			$jobActive = "Y";
		}else{
			$jobActive = validateInputData($_POST['jobActiveAdd']);
			if(empty($jobActive)){
				$jobActive = "Y";
			}else{
				$jobActive = $_POST['jobActiveAdd']);
			}
		}

		
	}
	
	// echo $err;
	echo json_encode($arrOut);
?>