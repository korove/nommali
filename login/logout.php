<?php 
	session_start();
	session_destroy();
	ob_start();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="text-align: center;">
<h2 style='color:red;margin-top:15px;'>คุณได้ทำการออกจากระบบเรียบร้อยแล้ว<h2>
<img src="/nommali/images/gif/spiffygif_72x72.gif" alt="กรุณารอสักครู่ กำลัเข้าสู่หน้าหลัก">
</body>
</html>
<?php 
	header("Refresh: 2; url=/nommali/index.php");
	ob_end_flush();
	exit;
?>
