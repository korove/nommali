<?php
	
	if(isset($_POST['aboutUs'])){
		$aboutUs = $_POST['aboutUs'];
	}else{
		$aboutUs = '';
	}
	
	echo '$aboutUs = ' . $aboutUs . '<br/>'; 

	if($aboutUs !== ''){
		include './database/conDb.php';
	}
	
?>

	<form method="post" action="index.php?page=aboutUs">

		<h1>เกี่ยวกับเรา</h1><br>
		 <textarea name="aboutUs" rows="10" cols="100">
			เราเป็นผู้ผลิตนมข้นหวาน
		 </textarea><br/>
		<input type="submit" value="ตกลง">

	</form> 

<?php
	include './database/closeDb.php';
?>