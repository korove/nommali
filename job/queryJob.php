<?php
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	require_once("{$base_dir}database{$ds}conDb.php");
	require_once("{$base_dir}include{$ds}function.php");

	$jobName = isset($_POST['jobName']) ? validateInputData($_POST['jobName']) : "";
	$jobAmount = isset($_POST['jobAmount']) ? validateInputData($_POST['jobAmount']) : "";

	// ###################### Query ######################
	$sql = 'SELECT * FROM job where 1 = ? ';
	if(!empty($jobName)) $sql.= ' and jobname = ? ';

	$paramTemp = 1;
	$stmt = $conn->prepare($sql);

	if(!empty($jobName)){
		$stmt->bind_param('s', $paramTemp, $jobName);
	} else {
		$stmt->bind_param('s', $paramTemp);	
	}
	
	$stmt->execute();
	$result = $stmt->get_result();


	$hasPosition = false;

	if ($result->num_rows > 0) {
		$hasPosition = true;
		echo "<br/>$result->num_rows > 0<br/>";
	    // output data of each row
	    // while($row = $result->fetch_assoc()) {
	    //     echo "positionName: " . $row["positionName"] . "<br>";
	    // }
	} else {
	    echo "<br/>0 results";
	}
	// End ###################### Query ######################

?>