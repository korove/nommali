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
	<link rel="stylesheet" type="text/css" href="/nommali/jPaginate/css/style.css" media="screen"/>
        <style>
            body{
                background: #a7c7dc url(bg.png) repeat-x top left;
                font-family: verdana;
                padding:0px;
                margin:0px;
                letter-spacing:2px;
            }
            .header{
                position:absolute;
                top:0px;
                left:0px;
                width:100%;
                height:80px;            
            }
            .header h1{
                color:#fff;
                font-size: 38px;
                margin:0px 0px 0px 30px;
                font-weight:100;
                line-height:80px;
                padding:0px;
            }
            .footer{
                width:100%;
                margin:10px 0px 5px 0px;
            }
            a img{
                border:none;
                outline:none;
            }
            .content{
                margin-top:100px;
                padding:0px;
                bottom:0px;
            }
            .about{
                width:100%;
                height:400px;
                background:transparent url(about.png) repeat-x top left;
                border-top:2px solid #ccc;
                border-bottom:2px solid #000;
            }
            .about .text{
                width:16%;
                margin:5px 2% 10px 2%;
                height:380px;
                float:left;
                color:#FCFEF3;
                font-size: 16px;
                text-align:justify;
                letter-spacing:0px;
            }
            .about .text h1{
                border-bottom: 1px dashed #ccc;
                color:#fff;
            }
            .demo{
                width:580px;
                padding:10px;
                margin:10px auto;
                border: 1px solid #fff;
                background-color:#f7f7f7;
            }
            h1{
                color:#404347;
                margin:5px 30px 20px 0px;
                font-weight:100;
            }
			.pagedemo{
				border: 1px solid #CCC;
				width:310px;
				margin:2px;
                padding:50px 10px;
                text-align:center;
				background-color:white;	
			}
        </style>
	<script src="/nommali/js/jquery-2.1.1.min.js"></script>
	<script src="/nommali/js/jquery.blockUI.js"></script>
	<script src="/nommali/js/jquery.form.min.js"></script>
	<script src="/nommali/bootstrap-3.3.4/dist/js/bootstrap.min.js"></script>
	<script src="/nommali//jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="/nommali/css/home.css">
	<link rel="stylesheet" type="text/css" href="/nommali/css/admin.css">
	<link rel="stylesheet" type="text/css" href="/nommali/css/font-awesome-4.3.0/css/font-awesome.min.css">
	
	<script src="/nommali/js/homeScript.js"></script>
	<script src="/nommali/js/numberformat.js"></script>
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

		<div id="contentAdm" style="background-color: #C7F6F9;">
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


		<script src="/nommali/jPaginate/jquery.paginate.js" type="text/javascript"></script>

</body>

</html>
