<?php session_start(); 
	ob_start();
	include('./include/function.php');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin Log In</title>
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
	
	<script src="./js/homeScript.js"></script>
	<style>
		.divLogin {
		    width: 40%;
		    margin: 0 auto;
		    margin-bottom: 70px;
		}
	</style>
	<script>
		$(function(){
			$('#btnLoginAdm').click(function(event){
				//alert(444);
				event.preventDefault();

				var urlSend='/nommali/admin/loginAdm.php';
				var dataSend=$('#frmLoginAdm').serializeArray();

				// alert(dataSend);
				$.ajax({
					url:urlSend,
					type:'post',
					data:dataSend,
					dataType:'json',
					beforeSend:function(){
						$.blockUI();
					},
					error:function(xhr, textStatus){
						// alert(111);
						var msg = 'xhr: ' + xhr.status;
						//alert(msg);
						$('#divErrMsg').html('<h4 style="color:red;">msg:' + msg+"</h4>");
					},
					complete:function(){
						// alert(222);
						$.unblockUI();	
					},
					success:function(result){
						// alert(333);
						// alert(result.msg);
						// alert(result);
						$('#divErrMsg').html(result.msg);
						if(result.msgWelcome != ""){
							var root = location.protocol + '//' + location.host;
							document.location.href = root + '/nommali/index.php';
						}
					}
				});
			});

		});
	</script>
</head>

<body>
	<div id="wrapper">

		<div id="content" style="text-align:center;margin-top:-10px;">
			<div class="divLogin">
				<form id="frmLoginAdm" action="portal.php" method="post">
					<h4 style="font-size:150%;">เข้าสู่ระบบ</h4>
					<div class="input-group input-group-lg">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-user"></span>	
						</span>
						<input type="text" class="form-control" id="userLogin" name="userLogin"
						    	placeholder="กรอก Username">
					</div>

					<div class="input-group input-group-lg">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-lock"></span>	
						</span>
						<input type="password" class="form-control" id="password" name="password"
				    	placeholder="กรอก Password">
					</div>

					<button id="btnLoginAdm" type="submit" class="btn btn-default" style="margin-top:7px;">เข้าสู่ระบบ</button>

				</form>
			</div>

			<div class="divLogin" id="divErrMsg" style="color:red;width: 60%;font-size: 150%;width:100%;">
			</div>

		</div>

	</div>
</body>

</html>

<?php 
	ob_end_flush();
	exit;
?>
