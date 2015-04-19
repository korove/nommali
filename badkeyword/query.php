<?php
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	require_once("{$base_dir}database{$ds}conDb.php");
	require_once("{$base_dir}include{$ds}function.php");

	// $badkeywordName = isset($_POST['badkeywordName']) ? validateInputData($_POST['badkeywordName']) : "";
	// $badkeywordAmount = isset($_POST['badkeywordAmount']) ? validateInputData($_POST['badkeywordAmount']) : "";
	$badkeywordName = empty($_POST['badkeywordName']) ? "" : validateInputData($_POST['badkeywordName']);
	$badkeywordAmount = empty($_POST['badkeywordAmount']) ? "" : validateInputData($_POST['badkeywordAmount']);
	$badkeywordActiveQuery = empty($_POST['badkeywordActiveQuery']) ? "" : validateInputData($_POST['badkeywordActiveQuery']);

	$hasFirstParamBefore = false;

	$sql  = "select * from badkeyword";

	if(!empty($badkeywordName)){
		if(!$hasFirstParamBefore){
			$sql .=	" where badkeywordname like :badkeywordname";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or badkeywordname like :badkeywordname";
		}
	}

	if(!empty($badkeywordActiveQuery) && $badkeywordActiveQuery !== 'All'){
		if(!$hasFirstParamBefore){
			$sql .=	" where activeFlg = :activeFlg";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or activeFlg = :activeFlg";
		}
	}

	// echo $sql;
	// exit;
	$stmt = $conPDO->prepare($sql);
	if(!empty($badkeywordName)) $stmt->bindValue(':badkeywordname', "%$badkeywordName%", PDO::PARAM_STR);
	if(!empty($badkeywordActiveQuery) && $badkeywordActiveQuery !== 'All') $stmt->bindValue(':activeFlg', $badkeywordActiveQuery, PDO::PARAM_STR);
	// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
	// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
	try{
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
	    echo 'Connection failed: ' . $e->getMessage();
	    exit;
	}


	if(!empty($rows)){
		$mapActiveFlg = array('Y'=>'แสดง', 'N'=>'ไม่แสดง');
		// echo 'not empty';
		// echo "<table id='tblResultQuerybadkeyword' style='color:blue'>";
		// echo "<table id='tblResultQuerybadkeyword' border='1'>";
		echo "<table id='tblResultQuerybadkeyword'>";
		echo "<tr>";
		echo "<th>คำหยาบ</th>";
		echo "<th>การแสดงผล</th>";
		echo "<th>แก้ไข</th>";
		echo "<th>ลบ</th>";
		echo "</tr>";
		foreach ($rows as $row) {
		    // echo "{$row['badkeywordname']}";
		    echo "<tr>";
			echo "<td>{$row['keyword']}</td>";


			echo "<td>";
?>
			<?php //echo "<option value='{$row['activeFlg']}'>".$mapActiveFlg[$row['activeFlg']]."</option>"; 
				echo $mapActiveFlg[$row['active']];
			?>
<?php
			echo "</td>";?>
			<td><button class="btnEditbadkeywordRow">แก้ไข</button>
			</td>
			<td><button class="btnDeletebadkeywordRow">ลบ</button>
			</td>

<?php		echo "</tr>";

		}
		echo "</table>";
	}else{
		echo '<h4 style="color:red;">ไม่พบข้อมูล</h4>';
	}
	// var_dump($rows);

	$hasPosition = false;

?>