<?php session_start(); ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Admin page</title>

  <link rel="stylesheet" href="./bootstrap-3.3.4/dist/css/bootstrap.min.css">

<!-- Optional theme -->
  <link rel="stylesheet" href="./bootstrap-3.3.4/dist/css/bootstrap-theme.min.css">
  <script src="./bootstrap-3.3.4/dist/js/jquery1.11.js"></script>
  <script src="./bootstrap-3.3.4/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/home.css">
  
</head>

<body>


	<div id="header">
		<div ><img src="logomali.jpg" style="width:120px;" /></div>
		<?php include 'header.php'; ?>
	</div>



	<div id="content">
	
		<?php

			$page = 'homeContent';
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}

			
			if (!empty($page)) {
				$page .= '.php';
				include($page);
			} else {
				include('homeContent.php');
			}
		?>

	</div>

	<div id="footer">
		<?php include 'footer.php'; ?>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>

</body>

</html>
