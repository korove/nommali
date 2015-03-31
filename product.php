
<form name="form1" method="post" action="save_upload.php" enctype="multipart/form-data">
Name : <input type="text" name="txtName"><br>
VDO Clip : <input type="file" name="filUpload"><br>
<input name="btnSubmit" type="submit" value="Submit">
</form>

<?php
	include './database/closeDb.php';
?>