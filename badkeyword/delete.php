<?php
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

	$badkeywordName = "";
	$badkeywordDetail = "";
	$badkeywordAmount = "";
	$badkeywordActive = "Y";

	if(empty($_POST['badkeywordNameAdd'])){
		$err .= "<li>กรุณากรอก 'ชื่อตำแหน่ง'</li>";
	}else{
		$badkeywordName = validateInputData($_POST['badkeywordNameAdd']);
		if(empty($badkeywordName)){
			$err .= "<li>กรุณากรอก 'ชื่อตำแหน่ง'</li>";
		}
	}

	if(empty($_POST['badkeywordDetailAdd'])){
		$err .= "<li>กรุณากรอก 'รายละเอียดงาน'</li>";
	}else{
		$badkeywordDetail = validateInputData($_POST['badkeywordDetailAdd']);
		if(empty($badkeywordDetail)){
			$err .= "<li>กรุณากรอก 'รายละเอียดงาน'</li>";
		}
	}

	if(empty($_POST['badkeywordAmountAdd'])){
		$err .= "<li>กรุณากรอก 'จำนวนที่รับ'</li>";
	}else{
		$badkeywordAmount = validateInputData($_POST['badkeywordAmountAdd']);
		if(empty($badkeywordAmount)){
			$err .= "<li>กรุณากรอก 'จำนวนที่รับ'</li>";
		}
	}

	if(!empty($err)){
		$arrOut['err'] = "<ul>". $err ."</ul>";
	}else{
		// No Error

		if(empty($_POST['badkeywordActiveAdd'])){
			$badkeywordActive = "Y";
		}else{
			$badkeywordActive = validateInputData($_POST['badkeywordActiveAdd']);
			if(empty($badkeywordActive)){
				$badkeywordActive = "Y";
			}else{
				$badkeywordActive = $_POST['badkeywordActiveAdd'];
			}
		}

		$sql  = "insert into badkeyword(badkeywordname,detail,amount,activeFlg) ";
		$sql .=	" values(:badkeywordname,:detail,:amount,:activeFlg)";
		
		$stmt = $conPDO->prepare($sql);

		try{
			$stmt->execute(array(':badkeywordname' => $badkeywordName, ':detail' => $badkeywordDetail, ':amount' => $badkeywordAmount, ':activeFlg' => $badkeywordActive));
			$affected_rows = $stmt->rowCount();

			$arrOut['successMsg'] = 'affected_rows = ' . $affected_rows;
		} catch (PDOException $e) {
			//var_dump($e->errorInfo);
			if($e->errorInfo[1] == 1062){
				// echo 'มีข้อมูลนี้อยู่แล้วในระบบ';
				$arrOut['err'] = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากมีข้อมูลนี้อยู่แล้วในระบบ';
			}else{
			    // echo 'Error: ' . $e->getMessage();
			    $arrOut['err'] = 'Error: ' . $e->getMessage();
			}
		}
	}

	// echo $err;
	echo json_encode($arrOut);

?>