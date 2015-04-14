<?php 
	sleep(2);
	// $root = realpath($_SERVER["DOCUMENT_ROOT"]);

	// include "$root/include/function.php";
	// include_once __DIR__.'\include\function.php';
	//include_once '../include/function.php';
	// include_once '/include/function.php';
	// $path = $_SERVER['DOCUMENT_ROOT'];
	// $path .= "include/function.php";
	// // //echo $path;
	// include_once($path);	

	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	require_once("{$base_dir}include{$ds}function.php");
	
	if(isset($_POST['userLogin'])){

		echo validateInputData($_POST['userLogin']);
	}else{
		echo 'test3';
	}

	
?>