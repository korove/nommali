

<?php
	
	include './database/conDb.php';
	
	// ###################### Query ######################
	$sql = "SELECT positionName, activeFlg FROM position where activeFlg = 'Y'";
	$result = $conn->query($sql);
	$hasPosition = false;

	if ($result->num_rows > 0) {
		$hasPosition = true;
		echo "<br/>$result->num_rows > 0<br/>";
	    // output data of each row
	    // while($row = $result->fetch_assoc()) {
	    //     echo "positionName: " . $row["positionName"] . "<br>";
	    // }
	} else {
	    echo "<br/>0 results";
	}
	// End ###################### Query ######################

?>

<h1>ร่วมงานกับเรา</h1>

<?php 

	if($hasPosition){
		echo '<table id="positionTbl" border="1" class="positionTblClass">';
		echo '<tr>';
		echo '<th style="text-align:center;">';
        echo "ตำแหน่ง";
        echo '</th>';
        echo '</tr>';
		while($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>';
	        echo $row["positionName"];
	        echo '</td>';
	        echo '</tr>';
	    }

	    echo '</table>';
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