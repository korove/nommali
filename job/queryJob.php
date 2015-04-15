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
	$jobActiveQuery = empty($_POST['jobActiveQuery']) ? "" : validateInputData($_POST['jobActiveQuery']);

	$hasFirstParamBefore = false;

	$sql  = "select * from job";

	if(!empty($jobName)){
		if(!$hasFirstParamBefore){
			$sql .=	" where jobname like :jobname";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or jobname like :jobname";
		}
	}

	if(!empty($jobActiveQuery) && $jobActiveQuery !== 'All'){
		if(!$hasFirstParamBefore){
			$sql .=	" where activeFlg = :activeFlg";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or activeFlg = :activeFlg";
		}
	}

	// echo $sql;
	// exit;
	$stmt = $conPDO->prepare($sql);
	if(!empty($jobName)) $stmt->bindValue(':jobname', "%$jobName%", PDO::PARAM_STR);
	if(!empty($jobActiveQuery) && $jobActiveQuery !== 'All') $stmt->bindValue(':activeFlg', $jobActiveQuery, PDO::PARAM_STR);
	// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
	// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


	if(!empty($rows)){
		// echo 'not empty';
		// echo "<table id='tblResultQueryJob' style='color:blue'>";
		echo "<table id='tblResultQueryJob' border='1'>";
		echo "<tr>";
		echo "<th>ชื่อตำแหน่ง</th>";
		echo "</tr>";
		foreach ($rows as $row) {
		    // echo "{$row['jobname']}";
		    echo "<tr>";
			echo "<td>{$row['jobname']}</td>";
			echo "</tr>";
		}
		echo "</table>";
	}else{
		echo '<h4 style="color:red;">ไม่พบข้อมูล</h4>';
	}
	// var_dump($rows);

	$hasPosition = false;

?>