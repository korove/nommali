<?php
	// test
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	// require_once("{$base_dir}database{$ds}conDb.php");
	// require_once("{$base_dir}include{$ds}function.php");

	$root = $_SERVER['DOCUMENT_ROOT'];
	$includePath = "nommali/include/";
   	require_once($root . "nommali/database/" ."conDb.php");
   	require_once($root . $includePath ."function.php");

   	$arrOut = array('err'=>'','successMsg'=>'','testMsg'=>'testMsg');

	$jobname = empty($_POST['jobName']) ? "" : validateInputData($_POST['jobName']);

	$arrOut['testMsg'] = "jobname = {$jobname}";
	
	$sql  = "delete from job " .
	" where jobname='{$jobname}'";
	
	if ($conn->query($sql) === TRUE) {
	    //echo "Record updated successfully";
	    $arrOut['testMsg'] .= "<br/>" . "Record updated successfully";
	} else {
	    //echo "Error updating record: " . $conn->error;
	    $arrOut['testMsg'] .= "<br/>" . "Error updating record: " . $conn->error;
	}

	$conn->close();

	echo json_encode($arrOut);

?>