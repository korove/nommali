<?php
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	require_once("{$base_dir}database{$ds}conDb.php");
	require_once("{$base_dir}include{$ds}function.php");

	// $jobName = isset($_POST['jobName']) ? validateInputData($_POST['jobName']) : "";
	// $jobAmount = isset($_POST['jobAmount']) ? validateInputData($_POST['jobAmount']) : "";
	$jobName = empty($_POST['jobName']) ? "" : validateInputData($_POST['jobName']);
	$jobAmount = empty($_POST['jobAmount']) ? "" : validateInputData($_POST['jobAmount']);

	// $hasWhere = false;
	$hasFirstParamBefore = false;

	// if(!empty($jobName) || !empty($jobAmount)){
	// 	$hasWhere = true;
	// }
	// ###################### Query ######################
	$sql  = "select * from job";

	if(!empty($jobName)){
		if(!$hasFirstParamBefore){
			$sql .=	" where jobname like :jobname";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or jobname like :jobname";
		}
	}

	if(!empty($jobName)){
		if(!$hasFirstParamBefore){
			$sql .=	" where jobname like :jobname";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or jobname like :jobname";
		}
	}

	// echo $sql;
	// exit;
	$stmt = $conPDO->prepare($sql);
	if(!empty($jobName)) $stmt->bindValue(':jobname', "%$jobName%", PDO::PARAM_STR);
	// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
	// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


	if(!empty($rows)){
		// echo 'not empty';
		echo 'result = ' . count($rows);
	}else{
		echo '<h4 style="color:red;">ไม่พบข้อมูล</h4>';
	}
	// var_dump($rows);
	/*foreach ($rows as $row) {
	    echo "{$row['jobname']}<br/>";
	}*/


	// if(!empty($jobName)) $sql.= ' and jobname = ? ';

	// $paramTemp = 1;
	// $stmt = $conPDO->prepare($sql);

	// if(!empty($jobName)){
	// 	$stmt->bind_param('s', $paramTemp, $jobName);
	// } else {
	// 	$stmt->bind_param('s', $paramTemp);	
	// }
	
	// $stmt->execute();
	// $result = $stmt->get_result();


	$hasPosition = false;

	// if ($result->num_rows > 0) {
	// 	$hasPosition = true;
	// 	echo "<br/>$result->num_rows > 0<br/>";
	//     // output data of each row
	//     // while($row = $result->fetch_assoc()) {
	//     //     echo "positionName: " . $row["positionName"] . "<br>";
	//     // }
	// } else {
	//     echo "<br/>0 results";
	// }
	// End ###################### Query ######################

?>