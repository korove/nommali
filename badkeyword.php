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
	<script>
$(function(){
	var jobNameForEdit = "";
	var editJobDone = false;
	$('#btnQuery').click(function(event){
		event.preventDefault();

		var url='/nommali/badkeyword/query.php';
		var data=$('#frmQuery').serializeArray();

		$.ajax({
			url:url,
			type:'post',
			data:data,
			beforeSend:function(){
				// $('#frmQueryJob').block();
				$.blockUI();
			},
			error:function(xhr, textStatus){
				// alert('xhr:'+ xhr +', textStatus:'+textStatus);
				var msg = 'xhr: ' + xhr.status;
				//alert(msg);
				$('#errQuery').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				// $('#frmQueryJob').unblock();
				$.unblockUI();	
			},
			success:function(result){
				$('#resultQuery').html(result);
			}
		});
	});

	$('#btnPrepareAddJob').click(function(event){
		event.preventDefault();
		$('#divPrepareAddJob').css('display', 'block');
	});

	$('#frmAdd td:first-child').css({'text-align':'right'});

	$('#btnAdd').click(function(event){
		event.preventDefault();

		var url='/nommali/badkeyword/add.php';
		var data=$('#frmAdd').serializeArray();
		/*$.each(data, function(i, field){
	        $("#errAddJob").append(field.name + ":" + field.value + ", ");
	    });*/

		$.ajax({
			url:url,
			type:'post',
			data:data,
			dataType:'json',
			beforeSend:function(){
				// $('#frmQueryJob').block();
				$.blockUI();
			},
			error:function(xhr, textStatus){
				// alert('xhr:'+ xhr +', textStatus:'+textStatus);
				var msg = 'xhr: ' + xhr.status;
				//alert(msg);
				$('#errAdd').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				// $('#frmQueryJob').unblock();
				$.unblockUI();	
			},
			success:function(result){
				// $('#errAddJob').html(result);
				$('#errAdd').html(result.err);
				$('#divResultAdd').html(result.successMsg);
			}
		});
	});

	$('body').on('click','#tblResultQuerybadkeyword .btnEditbadkeywordRow',function(event){
		
		event.preventDefault();
		
		var mapJobActive = '{"แสดง":"Y","ไม่แสดง":"N"}';
		var mapJobActiveObj = JSON.parse(mapJobActive);
	
		// alert(mapJobActiveObj['แสดง']);
		// var msg = event.target.className;
		// var msg = event.target.innerHTML;
		// var msg = $(this).parent().parent().children('td:first-child').html();

		$currentTr = $(this).parent().parent();
		$tdChilds = $currentTr.children();
		var rowid ="";
		var jobName = "";
		var jobDetail = "";
		var jobAmount = "";
		var jobActiveFlg = "";
		var tdEdit = "";
		var tdEditInner = "";

		$.each($tdChilds, function(index,item){
			if(index == 0){
				rowid = item.innerHTML;
				//alert(jobName);
			}
			else if(index == 1){
				jobName = item.innerHTML;
				var jobNameHtml = "";
				//alert(jobName);
			}else if(index == 2){
				if(!item.innerHTML){
					jobActiveFlg = 'แสดง';
				}else{
					jobActiveFlg = item.innerHTML.trim();	
				}
				jobActiveFlg = mapJobActiveObj[jobActiveFlg];
			}
			//alert(index);
		});

		$('#divEdit').css({'display':'block'});
		var jsonData = {rowid:rowid, jobName:jobName, 
						jobActiveFlg:jobActiveFlg};
		jobNameForEdit = jobName;

		$('#rowIdbandKeyWordNameEdit').val(rowid);
		$('#bandKeyWordNameEdit').val(jobName);
		$('#bandKeyWordNameActiveEdit').val(jobActiveFlg);
	});

	$('body').on('click','.btnDeletebadkeywordRow',function(){

		$currentTr = $(this).parent().parent();
		$tdChilds = $currentTr.children();
		var jobName = "";

		$.each($tdChilds, function(index,item){
			if(index == 0){
				jobName = item.innerHTML;
				var jobNameHtml = "";
			}
		});

		var result = confirm("คุณต้องการลบข้อมูล " + jobName + " ใช่หรือไม่");
		if (result) {
		    //Logic to delete the item
		    alert('Yes');
		}else{
			alert('No');
		}
	});

	$('#btnEditDone').click(function(event){
		event.preventDefault();

		var url='/nommali/badkeyword/edit.php';
		var data=$('#frmEdit').serializeArray();
		/*$.each(data, function(i, field){
	        $("#errAddJob").append(field.name + ":" + field.value + ", ");
	    });*/

		$.ajax({
			url:url,
			type:'post',
			data:data,
			dataType:'json',
			beforeSend:function(){
				// $('#frmQueryJob').block();
				$.blockUI();
			},
			error:function(xhr, textStatus){
				// alert('xhr:'+ xhr +', textStatus:'+textStatus);
				var msg = 'xhr: ' + xhr.status;
				//alert(msg);
				$('#errEdit').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				// $('#frmQueryJob').unblock();
				$.unblockUI();	
			},
			success:function(result){
				// $('#errAddJob').html(result);
				$('#errEdit').html(result.err);
				$('#divResultEdit').html(result.successMsg);
			}
		});
	});

	$('#btnEditCancel').click(function(event){
		event.preventDefault();
		$('#divEdit').css({'display':'none'});
	});

});



</script>

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
						<select id="badkeywordActiveQuery" name="badkeywordActiveQuery">
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
<div id="errEdit" style="color:red;"></div>
	<fieldset><legend>แก้ไขคำหยาบ</legend>
		<form id="frmEdit">
			<table >
			    <tr>
					<td>รหัส</td>
					<td><input type="text" name="rowIdbandKeyWordNameEdit" id="rowIdbandKeyWordNameEdit" 
							
						   style="width:200px;" maxlength="255"></td>
				</tr>
				<tr>
					<td>คำหยาบ</td>
					<td><input type="text" name="bandKeyWordNameEdit" id="bandKeyWordNameEdit" 
							
						   style="width:200px;" maxlength="255"></td>
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
<div id="divResultEdit">
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
					<td><input type="text" name="badkeywordNameAdd" id="badkeywordNameAdd" 
						   style="width:200px;" maxlength="255"></td>
				</tr>

				<tr>
					<td>เปิดให้แสดง</td>
					<td>
						<select id="badkeywordActiveAdd" name="badkeywordActiveAdd">
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
