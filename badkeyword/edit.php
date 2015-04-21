<?php  
	// echo 'Add badkeyword 555';
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

	if(empty($_POST['bandKeyWordNameEdit'])){
		$err .= "<li>กรุณากรอก 'คำหยาบ'</li>";
	}else{
		$badkeywordName = validateInputData($_POST['bandKeyWordNameEdit']);
		if(empty($badkeywordName)){
			$err .= "<li>กรุณากรอก 'คำหยาบ'</li>";
		}
	}



	if(!empty($err)){
		$arrOut['err'] = "<ul>". $err ."</ul>";
	}else{
		// No Error

		if(empty($_POST['bandKeyWordNameActiveEdit'])){
			$badkeywordActive = "Y";
		}else{
			$badkeywordActive = validateInputData($_POST['bandKeyWordNameActiveEdit']);
			if(empty($badkeywordActive)){
				$badkeywordActive = "Y";
			}else{
				$badkeywordActive = $_POST['bandKeyWordNameActiveEdit'];
			}
		}$rowid = 1;

		$sql  = "update badkeyword set keyword=:bandKeyWordNameEdit ,";
		$sql .=	" active=:bandKeyWordNameActiveEdit where rowid=:rowid";
		
		$stmt = $conPDO->prepare($sql);
		
		try{
			$stmt->execute(array(':bandKeyWordNameEdit' => $badkeywordName, ':bandKeyWordNameActiveEdit' => $badkeywordActive , ':rowid' => $rowid ));
			$affected_rows = $stmt->rowCount();

			$arrOut['successMsg'] = 'affected_rows = ' . $affected_rows;
		} catch (PDOException $e) {
			//var_dump($e->errorInfo);
			if($e->errorInfo[1] == 1062){
				// echo 'มีข้อมูลนี้อยู่แล้วในระบบ';
				$arrOut['err'] = 'ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากมีข้อมูลนี้อยู่แล้วในระบบ';
			}else{
			    // echo 'Error: ' . $e->getMessage();
			    $arrOut['err'] = 'Error: ' . $e->getMessage();
			}
		}
	}

	// echo $err;
	echo json_encode($arrOut);
?>