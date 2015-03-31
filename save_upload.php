<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php


	if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"vdo/".$_FILES["filUpload"]["name"]))
	{
		echo "Copy/Upload Complete<br>";

		//*** Insert Record ***//
		$objConnect = mysql_connect("localhost","root","root") or die("Error Connect to Database");
		$objDB = mysql_select_db("mydatabase");
		$strSQL = "INSERT INTO files ";
		$strSQL .="(Name,FilesName,Size,ContentType) VALUES ('".$_POST["txtName"]."' ,'".$_FILES["filUpload"]["name"]."' ,'".$_FILES["filUpload"]["size"]."' ,'".$_FILES["filUpload"]["type"]."')";
		$objQuery = mysql_query($strSQL);		

		mysql_close($objConnect);
	}
?>
<a href="allfiles.php">View files</a>
</body>
</html>
