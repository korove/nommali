<!DOCTYPE html>
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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
    <meta name="author" content="">
	<title>Web Mali</title>
	<!-- Normalize Clean CSS -->
	<link href="css/normalize.css" rel="stylesheet">
	<!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
	<!-- Slide CSS -->
	<link href="css/iview.css" rel="stylesheet">
	<link href="css/slide.css" rel="stylesheet">
	<!-- jQuery Script -->
	<script src="js/jquery.min.js"></script>
	<!-- Slide JavaScript -->
	<script src="js/raphael-min.js"></script>
	<script src="js/jquery.easing.js"></script>
	<script src="js/iview.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    
	<script>
		$(document).ready(function(){
			$('#iview').iView({
				fx: "fade",
				pauseTime: 7000,
				pauseOnHover: true,
				directionNav: true,
				directionNavHide: false,
				controlNav: true,
				controlNavNextPrev: false,
				controlNavTooltip: false,
				directionNavHoverOpacity: 0,
				nextLabel: "Próximo",
				previousLabel: "Anterior",
				playLabel: "Jugada",
				pauseLabel: "Pausa",
				timer: "360Bar",
				timerBg: "#EEE",
				timerOpacity:0,
				timerColor: "#000",
				timerDiameter: 40,
				timerPadding: 4,
				timerStroke: 8,
				timerPosition: "bottom-right"
			});
			
			$('.menu > li').bind('mouseover', openSubMenu);
			$('.menu > li').bind('mouseout', closeSubMenu);
			
			function openSubMenu() {
				$(this).find('ul').css('visibility', 'visible');
			};
			
			function closeSubMenu() {
				$(this).find('ul').css('visibility', 'hidden');	
			};
		});
		
		$(document).ready(function(){
			$(".nav a").on("click", function(e) {
			   e.preventDefault();
			   e.stopPropagation();
			   //alert(222);
			});
		});
	</script>
	
	</head>

<body id="about">
<div id="cont">
		<!-- Header -->
		<div class="header">
			<div class="container">
				<div id="lang">
					<ul>
						<li class="right"><a href="index.html"><div id="lang-th"></div></a></li>
						<li><a href="index.html"><div id="lang-en"></div></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Menu -->
		<div class="nav">
			<div class="container">
				<div id="mali-logo"></div>
					<ul class="menu">
						<li class="selected"><a href="index.html">Home</a></li>
						<li ><a>About Us</a>
							<ul>
								<li><a href="history.html">History</a></li>
								<li><a href="certificate.html">Certificate</a></li>
								<li><a href="client.html">Client</a></li>
								<li><a href="contact.html">Contact Us</a></li>
							</ul>
						</li>
						<li><a>Products</a>
							<ul>
								<li><a href="domestic.html">Domestic</a></li>
								<li><a href="export.html">Export</a></li>
							</ul>
						</li>
						<li><a></a></li>
						<li><a>Recipes</a>
							<ul>
								<li><a href="food.html">Food</a></li>
								<li><a href="bakery.html">Bakery</a></li>
								<li><a href="beverage.html">Beverage</a></li>
							</ul>
						</li>
						<li><a>New & Event</a>
							<ul>
								<li><a href="promotion.html">Promotion</a></li>
								<li><a href="activities.html">Activities</a></li>
								<li><a href="crs.html">CRS</a></li>
							</ul>
						</li>
						<li><a href="faq.html">FAQ</a></li>
					</ul>
			</div>
		</div>
		<!-- Slide -->
		<div class="slide">
			<div class="container">
				<div id="iview">
					<div data-iview:image="photos/slide1.png">
					<div class="iview-caption caption1" data-x="0" data-y="250" data-transition="expandLeft">นมตรามะลิ
						<div style="font-size:24px;color:#000;margin-top:10px;">นมที่อยู่คู่คนไทยมากกว่า 50 ปี</div>
					</div>
					</div>
					<div data-iview:image="photos/slide2.png"></div>
					<div data-iview:image="photos/slide3.png"></div>
					<div data-iview:image="photos/slide4.png"></div>
				</div>
			</div>
		</div>
		<div class="blue-line container"></div>
		<!-- Content -->
		<div class="content">
			<div class="container">
				<div class="sidebox">
					<!-- Activities -->
					<div class="box">
						<h2>กิจกรรมล่าสุด</h2>
						<div class="box-content">
							<ul>
								<li><a href="#">เมนูอาหารเครื่องดื่ม</a></li>
								<li><a href="#">ยอดขายอันดับหนึ่งในกลุ่มนมข้น</a></li>
								<li><a href="#">AD ต่างๆของบริษัท</a></li>
								<li><a href="#">ศูนย์ข้อมูลผู้บริโภค</a></li>
							</ul>
						</div>
					</div>
					<!-- Products -->
					<div class="box">
						<h2>ผลิตภัณฑ์</h2>
						<div class="box-content">
							<ul>
								<li><a href="#">เมนูอาหารเครื่องดื่ม</a></li>
								<li><a href="#">ยอดขายอันดับหนึ่งในกลุ่มนมข้น</a></li>
								<li><a href="#">AD ต่างๆของบริษัท</a></li>
							</ul>
						</div>
					</div>
					<!-- FB Page -->
					<div class="box">
						<img src="photos/fb-thumb.png" width="200px" height="304px">
					</div>
					<!-- QR Code -->
					<div class="box">
						<img src="photos/qr-code.png" width="200px" height="211px">
					</div>
				</div>
				<!-- Content -->
				<div class="main-content">
					<?php include "{$base_dir}mali{$ds}mainHomeContent.php"; ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		
		
		
		<div class="footer">
			<div class="container">
				<div class="fcont">
					<div id="orchid-logo"></div>
				</div>
				<div class="fcont">
					<p>495 Soi Krungthep Kritha 7 khungthep Kritha Road, Bankok, Thailand 10240</p>
					<p>Tel: (662) 184-6700 Fax: (662) 184-6655, (662) 731-7367 (Export Dept.)</p>
				</div>
			</div>
		</div>
		<!-- Social Fixed -->
		<div id="social"></div>
		</div>
	</body>
</html>