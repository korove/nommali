

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
		echo '<table id="positionTbl" border="1">';
		echo '<tr>';
		echo '<th>';
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

<?php
	include './database/closeDb.php';
?>