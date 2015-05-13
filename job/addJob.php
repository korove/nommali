<?php  
	// echo 'Add job 555';
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	require_once("{$base_dir}database{$ds}conDb.php");
	require_once("{$base_dir}include{$ds}function.php");

	$err = "";
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
				$jobActive = $_POST['jobActiveAdd'];
			}
		}

		$sql  = "insert into job(jobname,detail,amount,activeFlg) ";
		$sql .=	" values(:jobname,:detail,:amount,:activeFlg)";
		
		$stmt = $conPDO->prepare($sql);

		try{
			$stmt->execute(array(':jobname' => $jobName, ':detail' => $jobDetail, ':amount' => $jobAmount, ':activeFlg' => $jobActive));
			$affected_rows = $stmt->rowCount();
// 			$arrOut['successMsg'] = 'affected_rows = ' . $affected_rows;
			if($affected_rows > 0){
				$arrOut['successMsg'] = "<h4 style='color:blue;'>เพิ่มข้อมูลเรียบร้อยแล้ว</h4>";
			}else{
				$arrOut['err'] = "<h4 style='color:red;'>ไม่สามารถเพิ่มข้อมูลได้</h4>";
			}
			
			
		} catch (PDOException $e) {
			//var_dump($e->errorInfo);
			if($e->errorInfo[1] == 1062){
				// echo 'มีข้อมูลนี้อยู่แล้วในระบบ';
				$arrOut['err'] = "<h4 style='color:red;'>ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากมีข้อมูลนี้อยู่แล้วในระบบ</h4>";
			}else{
			    // echo 'Error: ' . $e->getMessage();
			    $arrOut['err'] = "<h4 style='color:red;'>Error: " . $e->getMessage() . "</h4>";
			}
		}
	}

	// echo $err;
	echo json_encode($arrOut);
?>