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

	$('#btnQueryJob').click(function(event){
		event.preventDefault();

		var url='/nommali/job/queryJob.php';
		var data=$('#frmQueryJob').serializeArray();

		$.ajax({
			url:url,
			type:'post',
			data:data,
			beforeSend:function(){
				$('#frmQueryJob').block();
				// $.blockUI({
				// 	message:'<h3>Loading</h3>',
				// 	css:{color:'red', background:'yellow',
				// 		 border:'none'}
				// });
			},
			error:function(xhr, textStatus){
				// alert('xhr:'+ xhr +', textStatus:'+textStatus);
				var msg = 'xhr: ' + xhr.status;
				//alert(msg);
				$('#errQueryJob').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				$('#frmQueryJob').unblock();
				// $.unblockUI();	
			},
			success:function(result){
				$('#resultQueryJob').html(result);
			}
		});
	});

});
</script>

<h1>ร่วมงานกับเรา</h1>
<div id="errQueryJob" class="errorMsg">
	
</div>
<fieldset>
	<legend>ค้นหาตำแหน่ง</legend>
	<form id="frmQueryJob" style="margin-top:-7px;">
		<table >
			<tr>
				<td>ชื่อตำแหน่ง</td>
				<td>จำนวน</td>
				<td></td>
			</tr>
			<tr>
				<td><input type="text" name="jobName" id="jobName" 
					   style="width:200px;" maxlength="255"></td>
				<td><input type="text" name="jobAmount" id="jobAmount" 
					   style="width:100px;"	class="inputNumber" maxlength="2"></td>
				<td><button id="btnQueryJob">ค้นหา</button></td>
			</tr>
		</table>
	</form>
</fieldset>
<div id="resultQueryJob">
	
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



<script>
jQuery( document ).ready(function() {
 	
	// window.onload = function() {
	// 	document.getElementById('positionTbl').className = 'positionTblClass';
	// };

 //    jQuery( "#positionTbl" ).load(function( event ) {
 //    	alert('5555555555555');
 // 		 $("div").addClass("positionTblClass");
 
 //    });
 
}); 
</script>			

<?php
	include './database/closeDb.php';
?>