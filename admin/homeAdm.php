<?php 
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo "{$ds}<br/>";
	// echo "{$base_dir}<br/>";
	// echo "{$base_dir}include{$ds}function.php<br/>";
	//include_once("{$base_dir}include{$ds}function.php");
	// include_once("{$ds}nommali{$ds}include{$ds}function.php");
	$root = $_SERVER['DOCUMENT_ROOT'];
	$includePath = "nommali/include/";
   	$path = $root . $includePath ."function.php";
   	include_once($path);

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin page</title>
	<link rel="stylesheet" href="/nommali/bootstrap-3.3.4/dist/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="/nommali/bootstrap-3.3.4/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/nommali/jquery-ui-1.11.4.custom/jquery-ui.css">

	<script src="/nommali/js/jquery-2.1.1.min.js"></script>
	<script src="/nommali/js/jquery.blockUI.js"></script>
	<script src="/nommali/js/jquery.form.min.js"></script>
	<script src="/nommali/bootstrap-3.3.4/dist/js/bootstrap.min.js"></script>
	<script src="/nommali//jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="/nommali/css/home.css">
	<link rel="stylesheet" type="text/css" href="/nommali/css/admin.css">
	
	<script src="/nommali/js/homeScript.js"></script>
	<script>
		// $(function(){
		// 	var welcomeAdminPage=location.pathname+'admin/welcomeAdmin.php';
		// 	// alert(welcomeAdminPage);
		// 	$('#welcomeAdmin').load(welcomeAdminPage, function() {
		// 	    //$(this).fadeIn();
		// 	});
		// });
	</script>
</head>

<body>

		<div id="headerAdm">
			<div ><img src="/nommali/logomali.jpg" style="width:120px;" /></div>
		</div>

		<div id="navAdm">
			<?php include "{$base_dir}headerAdm.php"; ?>
		</div>

		<div id="contentAdm">
			<div style="width:600px;">

			</div>
			<?php

				$page = '';
				if(isset($_GET['page'])){
					$page = $_GET['page'];
				}
				
				if (!empty($page) && ($page != 'contentAdm')) {
					$page .= '.php';
					include($root . "nommali/admin/". $page);
				} else {
					echo '<h4>this is admin home content</h4>';
				}
			?>
		</div>

		<div id="footerAdm">
			<?php include("{$base_dir}admin{$ds}footerAdm.php"); ?>
		</div>

</body>

</html>
