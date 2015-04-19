<?php
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;

	$root = $_SERVER['DOCUMENT_ROOT'];
	$pathconDb = $root."nommali/database/conDb.php";
	$pathinclude = $root."nommali/include/function.php";
	require_once($pathinclude);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	
<h1>จัดการคำหยาบ</h1>
<div id="errQuery" class="errorMsg">
	
</div>


<div id="divQuery">
	<fieldset>
		<legend>ค้นหาคำหยาบ</legend>
		<form id="frmQuery" style="margin-top:-7px;">
			<table >
				<tr>
					<td>คำหยาบ</td>
					<!-- <td>จำนวน</td> -->
					<td>ที่แสดงแล้ว</td>
					<td></td>
				</tr>
				<tr>
					<td><input type="text" name="bandKeyWordName" id="bandKeyWordName" 
						   style="width:200px;" maxlength="255"></td>
					<td>
						<select id="ActiveQuery" name="ActiveQuery">
						  <option value="All" selected>เลือกทั้งหมด</option>
						  <option value="Y">แสดงแล้ว</option>
						  <option value="N">ยังไม่แสดง</option>
						</select>
					</td>
					
					<td><button id="btnQuery">ค้นหา</button></td>
				</tr>
			</table>
		</form>
		
	</fieldset>
</div>
<div id="resultQuery" style="margin-top:5px;"></div>



<div id="divEdit" style="margin-top:5px;display:none;">
	<fieldset><legend>แก้ไขตำแหน่งงาน</legend>
		<form id="frmEdit">
			<table >
				<tr>
					<td>คำหยาบ</td>
					<td><input type="text" name="bandKeyWordNameEdit" id="bandKeyWordNameEdit" 
							class="readonlyStyle" disabled="true" 
						   style="width:200px;" maxlength="255" readonly="true"></td>
				</tr>

				<tr>
					<td>เปิดให้แสดง</td>
					<td>
						<select id="bandKeyWordNameActiveEdit" name="bandKeyWordNameActiveEdit">
						  <option value="Y" selected>แสดง</option>
						  <option value="N">ไม่แสดง</option>
						</select>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<button id="btnEditDone">แก้ไข</button>
						<button id="btnEditCancel" style="margin-left:5px;">ยกเลิก</button>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
</div>

<hr/>
<div id="divAdd" style="position:relative;left:2px;top:3px;">
	<button id="btnPrepareAdd" >เพิ่มคำหยาบ</button>
</div>

<div id="divPrepareAdd" style="position:relative;left:2px;top:3px;">
	<div id="errAdd" style="color:red;"></div>
	<fieldset>
		<legend>เพิ่มคำหยาบ</legend>
		<form id="frmAdd" style="margin-top:-7px;">
			<table >
				<tr>
					<td>คำหยาบ</td>
					<td><input type="text" name="jobNameAdd" id="jobNameAdd" 
						   style="width:200px;" maxlength="255"></td>
				</tr>

				<tr>
					<td>เปิดให้แสดง</td>
					<td>
						<select id="jobActiveAdd" name="jobActiveAdd">
						  <option value="Y" selected>แสดง</option>
						  <option value="N">ไม่แสดง</option>
						</select>
					</td>
				</tr>

				<tr>
					<td></td>
					<td><button id="btnAdd">เพิ่ม</button></td>
				</tr>
			</table>
		</form>
		
	</fieldset>
</div>

<div id="divResultAdd">
	
</div>

<?php
	include './database/closeDb.php';
?>
