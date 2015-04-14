<?php session_start(); 
	include('./include/function.php');
?>
<?php 

	// $link = mysqli_connect("local", "root", "add", "dff");
	// if(!$link){
	// 	exit("exit");
	// }

	// $link = @mysqli_connect("local", "root", "add", "dff")
	// 		or die("cannot connect");

	// $link = @mysqli_connect("local", "root", "add", "dff")
	// 		or die(mysqli_connect_error());

 ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin page</title>
	<link rel="stylesheet" href="./bootstrap-3.3.4/dist/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="./bootstrap-3.3.4/dist/css/bootstrap-theme.min.css">
	<script src="./js/jquery-2.1.1.min.js"></script>
	<script src="./js/jquery.blockUI.js"></script>
	<script src="./js/jquery.form.min.js"></script>
	<script src="./bootstrap-3.3.4/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/home.css">
	
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

	<div id="wrapper">
		<div id="header">
			<div ><img src="logomali.jpg" style="width:120px;" /></div>
			<?php include 'header.php'; ?>
		</div>



		<div id="content">
			<div id="welcomeAdmin">
				<?php 
					if(isset($_SESSION['sess_admin'])){
						echo "ยินดีต้อนรับคุณ {$_SESSION['sess_admin']}";
					}
				?>
			</div>

			<div id="logout">
				<?php 
					if(isset($_SESSION['sess_admin'])){
						echo '<form action="/nommali/login/logout.php">';
						echo 	'<input type="submit" value="ออกจากระบบ">';
						echo '</form>';
					}
				?>
				
			</div>

			<hr>
			<?php echo __DIR__ ?><br>
			<?php echo __FILE__ ?>
			<div style="width:600px;">
				<div id="msgLogin"></div>
				<fieldset><legend>Log In</legend>
					<form id="frmLogin3">
						<table width="270px;">
							<tr>
								<td>
									<label for="userLogin" class="label">User Name</label>							
								</td>
								<td>
									<input type="text" name="userLogin" id="userLogin"
										class="input">
								</td>
							</tr>
							<tr>
								<td>
									<label for="password" class="label">Password</label>
								</td>
								<td>
									<input type="password" name="password" id="password"
										class="input">
								</td>
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<button id="btnLogin" style="float:left;">เข้าสู่ระบบ</button>
								</td>
							</tr>

						</table>
					</form>	
				</fieldset>
			</div>

			
			<?php
				$temp = "<script>location.href('http://www.hacked.com')</script>";
				echo '<br/>'. validateInputData($temp);
				//echo '<br/>'. filter_var($temp, FILTER_SANITIZE_STRING);


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

		<?php include './modal/homeModal.php'; ?>
	</div>
</body>

</html>
