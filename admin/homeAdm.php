<?php 
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	echo "{$ds}<br/>";
	echo "{$base_dir}<br/>";
	echo "{$base_dir}include{$ds}function.php<br/>";
	include("{$base_dir}include{$ds}function.php");
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin page</title>
	<link rel="stylesheet" href="./bootstrap-3.3.4/dist/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="./bootstrap-3.3.4/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="./jquery-ui-1.11.4.custom/jquery-ui.css">

	<script src="./js/jquery-2.1.1.min.js"></script>
	<script src="./js/jquery.blockUI.js"></script>
	<script src="./js/jquery.form.min.js"></script>
	<script src="./bootstrap-3.3.4/dist/js/bootstrap.min.js"></script>
	<script src="./jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/home.css">
	<link rel="stylesheet" type="text/css" href="./css/admin.css">
	
	<script src="./js/homeScript.js"></script>
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

	<div id="wrapperAdm">
		<div id="headerAdm">
			<div ><img src="/nommali/logomali.jpg" style="width:120px;" /></div>
		</div>



		<div id="contentAdm">
			<?php echo __DIR__ ?><br>
			<?php echo __FILE__ ?>
			<div style="width:600px;">
			</div>

		</div>



		<div id="footerAdm">
			<?php include("{$base_dir}footerAdm.php"); ?>
		</div>

	</div>
</body>

</html>
