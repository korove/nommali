<div>
<?php 
	include("{$base_dir}database{$ds}queryCmMaster.php");
	include("{$base_dir}mali{$ds}IMGallery{$ds}imgallery-no-jquery.php");
// 	include "/nommali_Project/mali/IMGallery/imgallery-no-jquery.php";
	$pathImgTopic = "img{$ds}imgTopic{$ds}";
	gallery_thumb_height("100px");
	gallery_echo_img("{$pathImgTopic}img_news_20150621_112412.png");
	gallery_echo_img("img/imgTopic/img_news_20150621_170422.png");
	gallery_echo_img("img/imgTopic/img_news_20150621_170511.png");
	$debug = true;
	
	class CmMaster{
		public $rowid;
		public $parRowId;
		public $topic;
		public $detail;
		public $image;
		public $imageThumbnail;
		public $movie;
		public $type;
		public $displayHome;
		public $active;
	}
	
	$c = new CmMaster();
	$c->rowid = "2";
	
	function printTest($c){
		echo $c-> rowid;
	}
	printTest($c);
	//$rows = queryCmMasterOr($c);
	$newsList = queryCmMasterHome('news');
	
	if(empty($newsList)){
		prnt($debug, 'empty($newsList)' );
	}else{
		prnt($debug, '$newsList size: ' . count($newsList));
		//var_dump($newsList);
	}
	
?>
</div>

<div class="box2">
	<div class="column-6">
		<div id="about-logo"></div>
	</div>
	<div class="column-6">
		<h1>
			<a href="#">About Us</a>
		</h1>
		<p>was set up in 1962 as a joint venture between Thai and Malaysian
			businessmen with the Australian Dairy Corporation and was granted
			investment promotion privileges by the Board of Investment. The goal
			of the company was to manufacture dairy products thai milk. was set
			up in 1962 as a joint venture between Thai and Malaysian businessmen
			with the Australian Dairy Corporation .</p>
	</div>
</div>
<div class="clear"></div>

<div class="box3">
	<div class="red-arrow"></div>
	<div class="column-1">
		<div class="box3-header">
			<h2>ข่าว</h2>
			<a href="#"><div class="more">MORE +</div></a>
		</div>
		<?php 
		
			if(!empty($newsList)){
				foreach ($newsList as $row) {
					echo '<div class="box3-content1">';
					//$countAll = $row["count(*)"];
					gallery_echo_img("{$pathImgTopic}{$row['image']}");
// 					echo "<img src=\"{$pathImgTopic}{$row['image']}\">";
					echo "<p>{$row['topic']}</p>";
					echo '<a href="#">อ่านต่อ</a>';
					echo '</div>';
				}
			}
		
		?>
		
	</div>
	<div class="column-2">
		<div class="box3-header">
			<h2>VDO ข่าว</h2>
			<a href="#"><div class="more">MORE +</div></a>
			<div class="clear"></div>
		</div>
		<div class="box3-content2">
			<h3>นมตรามะลิได้ร่วมแสดงความยินดี...</h3>
			<img src="news/video1.png">
			<p>เมื่อวันที่ 23 มีนาคม 2558 ที่ผ่านมา คุณสุดถนอม กรรณสูด
				รองกรรมการผู้จัดการ
				นมตรามะลิได้ร่วมแสดงความยินดีกับหนังสือพิมพ์แนวหน้า</p>
			<a href="#">ดูคลิปวีดีโอ</a>
		</div>
	</div>
	<div class="clear"></div>
</div>


<div class="box3">
	<div class="red-arrow"></div>
	<div class="column-1">
		<div class="box3-header">
			<h2>กิจกรรม</h2>
			<a href="#"><div class="more">MORE +</div></a>
		</div>
		<div class="box3-content1">
			<img src="news/news1.png">
			<p>บริษัทอุตสาหกรรมไทยได้รับรางวัลชั้นน้ำ</p>
			<a href="#">อ่านต่อ</a>
		</div>
		<div class="box3-content1">
			<img src="news/news2.png">
			<p>บริษัทอุตสาหกรรมไทยได้รับรางวัลชั้นน้ำ</p>
			<a href="#">อ่านต่อ</a>
		</div>
		<div class="box3-content1">
			<img src="news/news3.png">
			<p>บริษัทอุตสาหกรรมไทยได้รับรางวัลชั้นน้ำ</p>
			<a href="#">อ่านต่อ</a>
		</div>
	</div>
	<div class="column-2">
		<div class="box3-header">
			<h2>Recipes VDO</h2>
			<a href="#"><div class="more">MORE +</div></a>
			<div class="clear"></div>
		</div>
		<div class="box3-content2">
			<img src="news/video2.png">
			<p>เมนูอาหารแนะนำกับผลิตภัณฑ์ตรามะลิ</p>
			<a href="#">ดูคลิปวีดีโอ</a>
		</div>
	</div>
	<div class="clear"></div>
</div>