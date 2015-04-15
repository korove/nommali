<?php
	
	include './database/conDb.php';
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
		echo "<br/>$result->num_rows > 0<br/>";
	} else {
	    echo "<br/>0 results";
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
		event.preventDefault();

		var url='/nommali/job/queryJob.php';
		var data=$('#frmQueryJob').serializeArray();

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
	});

	$('#btnPrepareAddJob').click(function(event){
		event.preventDefault();
		$('#divPrepareAddJob').css('display', 'block');
	});

	$('#frmAddJob td:first-child').css({'text-align':'right'});

	$('#btnAddJob').click(function(event){
		event.preventDefault();

		var url='/nommali/job/addJob.php';
		var data=$('#frmAddJob').serializeArray();
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
				$('#errAddJob').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				// $('#frmQueryJob').unblock();
				$.unblockUI();	
			},
			success:function(result){
				// $('#errAddJob').html(result);
				$('#errAddJob').html(result.err);
				$('#divResultAddJob').html(result.successMsg);
			}
		});
	});

	$('body').on('click','#tblResultQueryJob .btnEditJobRow',function(){
		// alert(111);
		event.preventDefault();

		var mapJobActive = '{"แสดง":"Y","ไม่แสดง":"N"}';
		var mapJobActiveObj = JSON.parse(mapJobActive);
		// alert(mapJobActiveObj['แสดง']);
		// var msg = event.target.className;
		// var msg = event.target.innerHTML;
		// var msg = $(this).parent().parent().children('td:first-child').html();

		$currentTr = $(this).parent().parent();
		$tdChilds = $currentTr.children();
		var jobName = "";
		var jobDetail = "";
		var jobAmount = "";
		var jobActiveFlg = "";
		var tdEdit = "";
		var tdEditInner = "";

		$.each($tdChilds, function(index,item){
			if(index == 0){
				jobName = item.innerHTML;
				var jobNameHtml = "";
				//alert(jobName);
			}else if(index == 1){
				jobDetail = item.innerHTML;
			}else if(index == 2){
				jobAmount = item.innerHTML;
			}else if(index == 3){
				if(!item.innerHTML){
					jobActiveFlg = 'แสดง';
				}else{
					jobActiveFlg = item.innerHTML.trim();	
				}
				jobActiveFlg = mapJobActiveObj[jobActiveFlg];
			}else if(index == 4){
				tdEdit = item;
				tdEditInner = tdEdit.innerHTML.trim();
				//alert(tdEditInner);
			}
			//alert(index);
		});

		$('#divEditJob').css({'display':'block'});
		var jsonData = {jobName:jobName, jobDetail:jobDetail, jobAmount:jobAmount,
						jobActiveFlg:jobActiveFlg};
		jobNameForEdit = jobName;
		$('#jobNameEdit').val(jobName);
		$('#jobDetailEdit').val(jobDetail);
		$('#jobAmountEdit').val(jobAmount);
		$('#jobActiveEdit').val(jobActiveFlg);
	});

	
	$('#btnEditJobCancel').click(function(event){
		event.preventDefault();
		$('#divEditJob').css({'display':'none'});
	});
});



</script>

<h1>ร่วมงานกับเรา</h1>
<div id="errQueryJob" class="errorMsg">
	
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
					<td><input type="text" name="jobName" id="jobName" 
						   style="width:200px;" maxlength="255"></td>
					<td>
						<select id="jobActiveQuery" name="jobActiveQuery">
						  <option value="All" selected>เลือกทั้งหมด</option>
						  <option value="Y">แสดงแล้ว</option>
						  <option value="N">ยังไม่แสดง</option>
						</select>
					</td>
					<!-- <td><input type="text" name="jobAmount" id="jobAmount" 
						   style="width:100px;"	class="inputNumber" maxlength="2"></td> -->
					<td><button id="btnQueryJob">ค้นหา</button></td>
				</tr>
			</table>
		</form>
		
	</fieldset>
</div>
<div id="resultQueryJob" style="margin-top:5px;">
	
</div>
<div id="divEditJob" style="margin-top:5px;display:none;">
	<fieldset><legend>แก้ไขตำแหน่งงาน</legend>
		<form id="frmEditJob">
			<table >
				<tr>
					<td>ชื่อตำแหน่ง</td>
					<td><input type="text" name="jobNameEdit" id="jobNameEdit" 
							class="readonlyStyle" disabled="true" 
						   style="width:200px;" maxlength="255" readonly="true"></td>
				</tr>

				<tr>
					<td>รายละเอียดงาน</td>
					<td><textarea name="jobDetailEdit" id="jobDetailEdit" cols="70" rows="7"></textarea></td>
				</tr>

				<tr>
					<td>จำนวนที่รับ</td>
					<td><input type="text" name="jobAmountEdit" id="jobAmountEdit" 
						   style="width:100px;"	class="inputNumber" maxlength="2"></td>
				</tr>

				<tr>
					<td>เปิดให้แสดง</td>
					<td>
						<select id="jobActiveEdit" name="jobActiveEdit">
						  <option value="Y" selected>แสดง</option>
						  <option value="N">ไม่แสดง</option>
						</select>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<button id="btnEditJobDone">แก้ไข</button>
						<button id="btnEditJobCancel" style="margin-left:5px;">ยกเลิก</button>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
</div>

<hr/>
<div id="divAddJob" style="position:relative;left:2px;top:3px;">
	<button id="btnPrepareAddJob" >เพิ่มตำแหน่ง</button>
</div>

<div id="divPrepareAddJob" style="position:relative;left:2px;top:3px;">
	<div id="errAddJob" style="color:red;"></div>
	<fieldset>
		<legend>เพิ่มตำแหน่ง</legend>
		<form id="frmAddJob" style="margin-top:-7px;">
			<table >
				<tr>
					<td>ชื่อตำแหน่ง</td>
					<td><input type="text" name="jobNameAdd" id="jobNameAdd" 
						   style="width:200px;" maxlength="255"></td>
				</tr>

				<tr>
					<td>รายละเอียดงาน</td>
					<td><textarea name="jobDetailAdd" id="jobDetailAdd" cols="70" rows="7"></textarea></td>
				</tr>

				<tr>
					<td>จำนวนที่รับ</td>
					<td><input type="text" name="jobAmountAdd" id="jobAmountAdd" 
						   style="width:100px;"	class="inputNumber" maxlength="2"></td>
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
					<td><button id="btnAddJob">เพิ่ม</button></td>
				</tr>
			</table>
		</form>
		
	</fieldset>
</div>

<div id="divResultAddJob">
	
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
	include './database/closeDb.php';
?>