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
			<div class="demo">
                <h1>Demo 1</h1>
                <div id="demo1">                   
                </div>
            </div>
			<div class="demo">
                <h1>Demo 2</h1>
                <div id="demo2">                   
                </div>
            </div>
			<?php include("{$base_dir}admin{$ds}footerAdm.php"); ?>
		</div>


		<script src="/nommali/jPaginate/jquery.paginate.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(function() {
			$("#demo1").paginate({
				count 		: 100,
				start 		: 1,
				display     : 8,
				border					: true,
				border_color			: '#fff',
				text_color  			: '#fff',
				background_color    	: 'black',	
				border_hover_color		: '#ccc',
				text_hover_color  		: '#000',
				background_hover_color	: '#fff', 
				images					: false,
				mouse					: 'press'
			});
			$("#demo2").paginate({
				count 		: 50,
				start 		: 5,
				display     : 10,
				border					: false,
				text_color  			: '#888',
				background_color    	: '#EEE',	
				text_hover_color  		: 'black',
				background_hover_color	: '#CFCFCF'
			});
			$("#demo3").paginate({
				count 		: 50,
				start 		: 20,
				display     : 12,
				border					: true,
				border_color			: '#BEF8B8',
				text_color  			: '#68BA64',
				background_color    	: '#E3F2E1',	
				border_hover_color		: '#68BA64',
				text_hover_color  		: 'black',
				background_hover_color	: '#CAE6C6', 
				rotate      : false,
				images		: false,
				mouse		: 'press'
			});
			$("#demo4").paginate({
				count 		: 50,
				start 		: 20,
				display     : 12,
				border					: false,
				text_color  			: '#79B5E3',
				background_color    	: 'none',	
				text_hover_color  		: '#2573AF',
				background_hover_color	: 'none', 
				images		: false,
				mouse		: 'press'
			});
			$("#demo5").paginate({
				count 		: 10,
				start 		: 1,
				display     : 7,
				border					: true,
				border_color			: '#fff',
				text_color  			: '#fff',
				background_color    	: 'black',	
				border_hover_color		: '#ccc',
				text_hover_color  		: '#000',
				background_hover_color	: '#fff', 
				images					: false,
				mouse					: 'press',
				onChange     			: function(page){
											$('._current','#paginationdemo').removeClass('_current').hide();
											$('#p'+page).addClass('_current').show();
										  }
			});
		});
		</script>

</body>

</html>
