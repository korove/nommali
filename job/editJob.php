<?php
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	// require_once("{$base_dir}database{$ds}conDb.php");
	// require_once("{$base_dir}include{$ds}function.php");

	$root = $_SERVER['DOCUMENT_ROOT'];
	$includePath = "nommali/include/";
   	require_once($root . "nommali/database/" ."conDb.php");
   	require_once($root . $includePath ."function.php");

   	$arrOut = array('err'=>'333','successMsg'=>'test','testMsg'=>'testMsg');

	$jobname = empty($_POST['jobNameEdit']) ? "" : validateInputData($_POST['jobNameEdit']);
	$detail = empty($_POST['jobDetailEdit']) ? "" : validateInputData($_POST['jobDetailEdit']);
	$amount = empty($_POST['jobAmountEdit']) ? "" : validateInputData($_POST['jobAmountEdit']);
	$activeFlg = empty($_POST['jobActiveEdit']) ? "" : validateInputData($_POST['jobActiveEdit']);

	$arrOut['testMsg'] = "jobname = {$jobname}, detail = " . $detail . ", amount = " . $amount . ", activeFlg = " . $activeFlg;
	//$sql  = "select * from job";
	// $sql  = "insert into job (jobname, detail, amount, activeFlg)" . 
	// " values(:jobname,:detail,:amount,:activeFlg)";

	// $sql  = "insert into job(jobname,detail,amount,activeFlg) ";
	// $sql .=	" values(:jobname,:detail,:amount,:activeFlg)";
	// $sql  = "update job set detail=':detail', amount=':amount', activeFlg=':activeFlg'" . 
	// " where jobname=':jobname2'";
	$sql  = "update job set detail='{$detail}', amount='{$amount}', activeFlg='{$activeFlg}'" . 
	" where jobname='{$jobname}'";
	
	if ($conn->query($sql) === TRUE) {
	    //echo "Record updated successfully";
	    $arrOut['testMsg'] .= "<br/>" . "Record updated successfully";
	} else {
	    //echo "Error updating record: " . $conn->error;
	    $arrOut['testMsg'] .= "<br/>" . "Error updating record: " . $conn->error;
	}

	$conn->close();

	// $stmt = $conPDO->prepare($sql);

	// try{
	// 	$stmt->execute(array(':detail' => $detail, ':amount' => $amount, ':activeFlg' => $activeFlg, ':jobname2' => $jobname));
	// 	$affected_rows = $stmt->rowCount();

	// 	$arrOut['successMsg'] = 'affected_rows = ' . $affected_rows;
	// } catch (PDOException $e) {
	// 	//var_dump($e->errorInfo);
	// 	if($e->errorInfo[1] == 1062){
	// 		// echo 'มีข้อมูลนี้อยู่แล้วในระบบ';
	// 		$arrOut['err'] = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากมีข้อมูลนี้อยู่แล้วในระบบ';
	// 	}else{
	// 	    // echo 'Error: ' . $e->getMessage();
	// 	    $arrOut['err'] = 'Error: ' . $e->getMessage();
	// 	}
	// }

	// echo $err;
	echo json_encode($arrOut);

	// $sql  = "update job set jobname=:jobname, detail=:detail, amount=:amount, activeFlg=:activeFlg" . 
	// " where jobname=:jobname2";

	// // echo $sql;
	// // exit;
	// $stmt = $conPDO->prepare($sql);
	// $stmt->bindValue(':jobname', $jobname, PDO::PARAM_STR);
	// $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
	// $stmt->bindValue(':amount', $amount, PDO::PARAM_INT);
	// $stmt->bindValue(':activeFlg', $activeFlg, PDO::PARAM_STR);
	// $stmt->bindValue(':jobname2', $jobname, PDO::PARAM_STR);

	// try{
	// 	$stmt->execute();
	// 	//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// } catch (PDOException $e) {
	//     // echo 'Connection failed: ' . $e->getMessage();
	//     $arrOut['err'] = 'Connection failed: ' . $e->getMessage();
	//     echo json_encode($arrOut);
	//     exit;
	// }


	// echo json_encode($arrOut);
?>