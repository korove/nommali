<?php
	//$currentPageSession = empty($_SESSION['currentPage']) ? 1 : $_SESSION['currentPage'];
	$root = $_SERVER['DOCUMENT_ROOT'];
	$includePath = "nommali/include/";
	$dbPath = "nommali/database/";
   	$path = $root . $includePath ."function.php";
   	include_once($path);
   	$path = $root . $dbPath . "conDb.php";
   	include_once($path);

	//include './database/conDb.php';
	// include('./include/function.php');
	// ###################### Query ######################
	// $sql = "SELECT positionName, activeFlg FROM position where activeFlg = 'Y'";
	// $result = $conn->query($sql);
	// $hasPosition = false;

	// if ($result->num_rows > 0) {
	// 	$hasPosition = true;
	// 	echo "<br/>$result->num_rows > 0<br/>";
	//     // output data of each row
	//     // while($row = $result->fetch_assoc()) {
	//     //     echo "positionName: " . $row["positionName"] . "<br>";
	//     // }
	// } else {
	//     echo "<br/>0 results";
	// }
	// End ###################### Query ######################

	// ###################### Insert PDO ######################
	/*$sql = "insert into job(jobname,detail,amount,activeFlg) " .
			" values(:jobname,:detail,:amount,:activeFlg)";
	$stmt = $conPDO->prepare($sql);

	$jobName = "jobname1";
	$jobDetail = "jobdetail1";
	$jobAmount = "jobAmount1";
	$jobActive = "Y";

	try {
		$stmt->execute(array(':jobname' => $jobName, ':detail' => $jobDetail, ':amount' => $jobAmount, ':activeFlg' => $jobActive));
	} catch (PDOException $e) {
		//var_dump($e->errorInfo);
		if($e->errorInfo[1] == 1062){
			echo 'มีข้อมูลนี้อยู่แล้วในระบบ';
		}else{
			echo 'Error Code: ' . $e->getCode() . ',<br/>';
		    echo 'Error: ' . $e->getMessage();
		}
	}
	
	$affected_rows = $stmt->rowCount();
	echo '$affected_rows = ' . $affected_rows;*/
	// ###################### End Insert PDO ######################

	// ###################### Update PDO ######################
	/*$sql = "update job set detail=:detail where jobname = :jobname";
			
	$stmt = $conPDO->prepare($sql);

	$jobName = "jobname1";
	$jobDetail = "test";
	$jobAmount = "23";
	$jobActive = "Y";

	$stmt->execute(array(':jobname' => $jobName, ':detail' => $jobDetail));
	$affected_rows = $stmt->rowCount();*/


	// ###################### Query ######################
	$hasPosition = false;
	$paramTemp = 1;
	$stmt = $conn->prepare('SELECT * FROM job where 1 = ?');
	$stmt->bind_param('s', $paramTemp);
	$stmt->execute();

	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$hasPosition = true;
		//echo "<br/>$result->num_rows > 0<br/>";
	} else {
	    //echo "<br/>0 results";
	}

	// $sql = "SELECT * FROM job";
	// $result = $conn->query($sql);
	// $hasPosition = false;

	// if ($result->num_rows > 0) {
	// 	$hasPosition = true;
	// 	echo "<br/>$result->num_rows > 0<br/>";
	//     // output data of each row
	//     // while($row = $result->fetch_assoc()) {
	//     //     echo "positionName: " . $row["positionName"] . "<br>";
	//     // }
	// } else {
	//     echo "<br/>0 results";
	// }
	// End ###################### Query ######################

?>

<script>
$(function(){
	var jobNameForEdit = "";
	var editJobDone = false;
	
	$('#btnQueryJob').click(function(event){
		clearMsg();
		$('#divPrepareAddJob').css({'display':'none'});
		$('#divEditJob').css({'display':'none'});
		$('#resultQueryJob').css('display', 'block');

		event.preventDefault();

		var url='/nommali/job/queryJob.php';
		var data=$('#frmQueryJob').serializeArray();

		$.ajax({
			url:url,
			type: 'post',
			data:data,
			//dataType: 'json',
			beforeSend:function(){
				$.blockUI();
			},
			error:function(xhr, textStatus){
				var msg = 'xhr: ' + xhr.status;
				$('#errQueryJob').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				$.unblockUI();	
			},
			success:function(result){
				$('#resultQueryJob').html(result);
			}
		});
	});

	$('#btnPrepareAddJob').click(function(event){
		clearMsg();
		event.preventDefault();
		$('#resultQueryJob').css('display', 'none');
		$('#divEditJob').css('display', 'none');
		$('#divPrepareAddJob').css('display', 'block');
// 		$('#jobNameAdd').focus();
		document.getElementById('jobNameAdd').scrollIntoView();
		$('#jobNameAdd').focus();
	});

	$('#frmAddJob td:first-child').css({'text-align':'right'});

	$('#btnAddJob').click(function(event){
		clearMsg();
		event.preventDefault();

		var url='/nommali/job/addJob.php';
		var data=$('#frmAddJob').serializeArray();

		$.ajax({
			url:url,
			type:'post',
			data:data,
			dataType:'json',
			beforeSend:function(){
				$.blockUI();
			},
			error:function(xhr, textStatus){
				var msg = 'xhr: ' + xhr.status;
				$('#errAddJob').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				$.unblockUI();	
			},
			success:function(result){
				if(!isEmpty(result.err)){
					clearMsg();
					$('#errAddJob').html(result.err);
					$('#divResultAddJob').html('');
				}

				if(!isEmpty(result.successMsg)){
					$('#divPrepareAddJob').hide();
					clearMsg();
					$('#divResultAddJob').html(result.successMsg);
					$('#errAddJob').html('');
				}
				
			}
		});
	});

	$('body').on('click','.btnDeleteJobRow',function(){

		$currentTr = $(this).parent().parent();
		$tdChilds = $currentTr.children();
		var jobName = "";

		$.each($tdChilds, function(index,item){
			if(index == 0){
				jobName = item.innerHTML;
				var jobNameHtml = "";
			}
		});

		var result = confirm("คุณต้องการลบตำแหน่ง " + jobName + " ใช่หรือไม่");
		if (result) {
		    //Logic to delete the item
		    var url='/nommali/job/deleteJob.php';
			var data={jobName: jobName};

			$.ajax({
				url:url,
				type:'post',
				data:data,
				beforeSend:function(){
					$.blockUI();
				},
				error:function(xhr, textStatus){
					var msg = 'xhr: ' + xhr.status;
					$('#errQueryJob').html('msg:' + msg+"");
				},
				complete:function(){
					$.unblockUI();	
				},
				success:function(result){
					//$('#resultQueryJob').html(result.testMsg);
					if(isEmpty(result.err)){
						//alert(111);
						var deleteFromPageNumber = $('#deleteFromPageNumber').val();
						var url='/nommali/job/queryJob.php';
						var data={currentPage:deleteFromPageNumber, changePaging:'true'};

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
								$('#errQueryJob').html('<h4 style="color:red;">msg:' + msg+"</h4>");
							},
							complete:function(){
								// $('#frmQueryJob').unblock();
								$.unblockUI();	
							},
							success:function(result){
								$('#resultQueryJob').html(result);
							}
						});
					}
					//successMsg
				}
			});
		}else{
			//alert('No');
		}
	});

	$('#btnEditJobCancel').click(function(event){
		event.preventDefault();
		$('#divEditJob').css({'display':'none'});
	});

	$('#btnEditJobDone').click(function(event){
		event.preventDefault();
		//$('#divEditJob').css({'display':'none'});

		var url='/nommali/job/editJob.php';
		var data=$('#frmEditJob').serializeArray();
		var editFromPageNumber = data[0].value;
// 		for(var key in data){
// 			alert('key = ' + key);
// 		}
		//alert('data[0].value = ' + data[0].value);
// 		for(var key in data[0]){
// 			alert('key = ' + key);
// 		}

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
				$('#errEditJob').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				// $('#frmQueryJob').unblock();
				$.unblockUI();	
			},
			success:function(result){
				// $('#errAddJob').html(result);
				$('#errEditJob').html(result.err);
				$('#resultEditJob').html(result.successMsg);
				//$('#resultEditJob').html(result.testMsg);
				if(result.err == ""){
					$('#divEditJob').css({'display':'none'});
					// Re query again
// 			  		event.preventDefault();

					var url='/nommali/job/queryJob.php';
					var data={currentPage:editFromPageNumber, changePaging:'true'};

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
							$('#errQueryJob').html('<h4 style="color:red;">msg:' + msg+"</h4>");
						},
						complete:function(){
							// $('#frmQueryJob').unblock();
							$.unblockUI();	
						},
						success:function(result){
							$('#resultQueryJob').html(result);
						}
					});
				}
			}
		});

		
	});

});



</script>

<h1>จัดการตำแหน่งงาน</h1>
<div id="errQueryJob" class="errorMsg errMsg">
	
</div>
<div id="divQueryJob">
	<fieldset>
		<legend>ค้นหาตำแหน่ง</legend>
		<form id="frmQueryJob" style="margin-top:-7px;">
			<table >
				<tr>
					<td>ชื่อตำแหน่ง</td>
					<!-- <td>จำนวน</td> -->
					<td>ที่แสดงแล้ว</td>
					<td></td>
				</tr>
				<tr>
					<td><input type="text" name="jobName" id="jobName" class="form-control"
						   style="width:200px;" maxlength="255"></td>
					<td>
						<select id="jobActiveQuery" name="jobActiveQuery" class="form-control" style="max-width: 150px;">
						  <option value="All" selected>เลือกทั้งหมด</option>
						  <option value="Y">แสดงแล้ว</option>
						  <option value="N">ยังไม่แสดง</option>
						</select>
					</td>
					<!-- <td><input type="text" name="jobAmount" id="jobAmount" 
						   style="width:100px;"	class="inputNumber" maxlength="2"></td> -->
					<td><button id="btnQueryJob" class="btn btn-default">ค้นหา</button></td>
					<td><button id="btnPrepareAddJob" class="btn btn-default">เพิ่มตำแหน่ง</button></td>
					
				</tr>
			</table>
			<input type="hidden" name="currentPage" value="1" id="currentPage">
		</form>
		
	</fieldset>
</div>
<div id="resultQueryJob" style="margin-top:5px;">
	
</div>

<div id="resultEditJob" style="margin-top:5px;" class="infoMsg">
	
</div>
<div id="errEditJob" style="margin-top:5px;color:red;" class="errMsg">
	
</div>
<div id="divEditJob" style="margin-top:5px;display:none;">
	<fieldset><legend>แก้ไขตำแหน่งงาน</legend>
		<form id="frmEditJob">
			<input id="editFromPageNumber" name="editFromPageNumber" type="hidden" value="1" />
			<table >
				<tr>
					<td>ชื่อตำแหน่ง</td>
					<td><input type="text" name="jobNameEdit" id="jobNameEdit" 
							class="readonlyStyle form-control"
						   style="width:200px;" maxlength="255" readonly></td>
				</tr>

				<tr>
					<td>รายละเอียดงาน</td>
					<td><textarea name="jobDetailEdit" id="jobDetailEdit" cols="70" rows="7" class="form-control"></textarea></td>
				</tr>

				<tr>
					<td>จำนวนที่รับ</td>
					<td><input type="text" name="jobAmountEdit" id="jobAmountEdit" class="form-control"
							onkeypress="return numberformat.keyPressIntegerOnly(this,event)"
						    style="width:100px;"  maxlength="2"></td>
				</tr>

				<tr>
					<td>เปิดให้แสดง</td>
					<td>
						<select id="jobActiveEdit" name="jobActiveEdit" class="form-control" style='max-width: 100px;'>
						  <option value="Y" selected>แสดง</option>
						  <option value="N">ไม่แสดง</option>
						</select>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<button id="btnEditJobDone" class="btn btn-default">แก้ไข</button>
						<button id="btnEditJobCancel" class="btn btn-default" style="margin-left:5px;">ยกเลิก</button>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
</div>

<div id="divAddJob" style="position:relative;left:2px;top:3px;">
	<!-- <button id="btnPrepareAddJob" >เพิ่มตำแหน่ง</button> -->
</div>

<div id="divPrepareAddJob" style="position:relative;left:2px;top:3px;display:none;">
	<fieldset>
		<legend>เพิ่มตำแหน่ง</legend>
		<form id="frmAddJob" style="margin-top:-7px;">
			<table >
				<tr>
					<td>ชื่อตำแหน่ง</td>
					<td><input type="text" name="jobNameAdd" id="jobNameAdd" class="form-control"
						   style="width:200px;" maxlength="255"></td>
				</tr>

				<tr>
					<td>รายละเอียดงาน</td>
					<td><textarea name="jobDetailAdd" id="jobDetailAdd" cols="70" rows="7" class="form-control"></textarea></td>
				</tr>

				<tr>
					<td>จำนวนที่รับ</td>
					<td><input type="text" name="jobAmountAdd" id="jobAmountAdd" class="form-control"
							onkeypress="return numberformat.keyPressIntegerOnly(this,event)"
						    style="width:100px;" maxlength="2"></td>
				</tr>

				<tr>
					<td>เปิดให้แสดง</td>
					<td>
						<select id="jobActiveAdd" name="jobActiveAdd" class="form-control" style='max-width: 100px;'>
						  <option value="Y" selected>แสดง</option>
						  <option value="N">ไม่แสดง</option>
						</select>
					</td>
				</tr>

				<tr>
					<td></td>
					<td><button id="btnAddJob" class="btn btn-default">เพิ่ม</button></td>
				</tr>
			</table>
		</form>
		
	</fieldset>
</div>
<br/>
<div id="errAddJob" style="color:red;" class="errMsg"></div>
<div id="divResultAddJob" class="infoMsg">
	
</div>


<?php 

	if($hasPosition){
		// echo '<table id="positionTbl" border="1" class="positionTblClass">';
		// echo '<tr>';
		// echo '<th style="text-align:center;">';
  //       echo "ตำแหน่ง";
  //       echo '</th>';
  //       echo '</tr>';
		// while($row = $result->fetch_assoc()) {
		// 	echo '<tr>';
		// 	echo '<td>';
	 //        echo $row["positionName"];
	 //        echo '</td>';
	 //        echo '</tr>';
	 //    }

	 //    echo '</table>';
	}
?>

<?php
	// include './database/closeDb.php';
	include_once($root . $dbPath . "closeDb.php");
?>