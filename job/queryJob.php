<?php
	session_start();
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	// echo $base_dir;
	require_once("{$base_dir}database{$ds}conDb.php");
	require_once("{$base_dir}include{$ds}function.php");

	$arrOut = array('err'=>'','successMsg'=>'','testMsg'=>'testMsg');
	$debug = true;
// 	if(){

// 	}
	// $jobName = isset($_POST['jobName']) ? validateInputData($_POST['jobName']) : "";
	// $jobAmount = isset($_POST['jobAmount']) ? validateInputData($_POST['jobAmount']) : "";
	$currentPage = empty($_POST['currentPage']) ? 1 : validateInputData($_POST['currentPage']);
	prnt($debug, "currentPage= " . $currentPage);
	if(empty($_POST['changePaging'])){
		prnt($debug, 'empty($_POST["changePaging"])');
		$jobName = empty($_POST['jobName']) ? "" : validateInputData($_POST['jobName']);
		$jobAmount = empty($_POST['jobAmount']) ? "" : validateInputData($_POST['jobAmount']);
		$jobActiveQuery = empty($_POST['jobActiveQuery']) ? "" : validateInputData($_POST['jobActiveQuery']);

		$_SESSION["jobNameSearch"] = $jobName;
		$_SESSION["jobAmountSearch"] = $jobAmount;
		$_SESSION["jobActiveQuerySearch"] = $jobActiveQuery;
		prnt($debug, "jobName= " . $jobName);
		prnt($debug, "jobAmount= " . $jobAmount);
		prnt($debug, "jobActiveQuery= " . $jobActiveQuery);
	}else{
		prnt($debug, 'not empty($_POST["changePaging"])');
		$jobName = $_SESSION["jobNameSearch"];
		$jobAmount = $_SESSION["jobAmountSearch"];
		$jobActiveQuery = $_SESSION["jobActiveQuerySearch"];
		prnt($debug, "jobName= " . $jobName);
		prnt($debug, "jobAmount= " . $jobAmount);
		prnt($debug, "jobActiveQuery= " . $jobActiveQuery);
	}
	

	$hasFirstParamBefore = false;

// 1	0,5
// 2	5,10
// 3	10,15

	// Count job ############################################
	$sql = "select count(*) from job";

	if(!empty($jobName)){
		if(!$hasFirstParamBefore){
			$sql .=	" where jobname like :jobname";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or jobname like :jobname";
		}
	}

	if(!empty($jobActiveQuery) && $jobActiveQuery !== 'All'){
		if(!$hasFirstParamBefore){
			$sql .=	" where activeFlg = :activeFlg";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or activeFlg = :activeFlg";
		}
	}

	// echo "sql = " . $sql;
	// echo "<br/>$jobActiveQuery = " . $jobActiveQuery;
	prnt($debug, 'SQL Count: ' . $sql);
	$stmt = $conPDO->prepare($sql);
	if(!empty($jobName)) $stmt->bindValue(':jobname', "%$jobName%", PDO::PARAM_STR);
	if(!empty($jobActiveQuery) && $jobActiveQuery !== 'All') $stmt->bindValue(':activeFlg', $jobActiveQuery, PDO::PARAM_STR);
	try{
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
	    echo 'Connection failed 1: ' . $e->getMessage();
	    $arrOut['err'] = 'Connection failed 1: ' . $e->getMessage();
	    exit;
	}

	$countAll = 0;
	if(!empty($rows)){
		prnt($debug, '!empty($rows)');
		foreach ($rows as $row) {
			//echo 'row["count(*)"]=' . $row["count(*)"];	
			$countAll = $row["count(*)"];
		}
	}
	// end Count job ########################################

	// Query job ############################################
	prnt($debug, '$countAll: ' . $countAll);
	if($countAll > 0){
		$_SESSION['currentPage'] = $currentPage;
		echo '$_SESSION["currentPage"] = ' . $_SESSION['currentPage'];   
		$limitRow = 5;
		$limitFirst = ($currentPage - 1) * $limitRow;
		$limitLast = $limitFirst + $limitRow;
		$totalPage = ceil($countAll / $limitRow);
		
		prnt($debug, '$currentPage: ' . $currentPage);
		prnt($debug, '$limitRow: ' . $limitRow);
		prnt($debug, '$limitFirst: ' . $limitFirst);
		prnt($debug, '$limitLast: ' . $limitLast);
		prnt($debug, '$totalPage: ' . $totalPage);
		//if($countAll % $limitRow != 0) $totalPage += 1;

		$hasFirstParamBefore = false;
		$sql = "select * from job";

		if(!empty($jobName)){
			if(!$hasFirstParamBefore){
				$sql .=	" where jobname like :jobname";
				$hasFirstParamBefore = true;
			}else{
				$sql .=	" or jobname like :jobname";
			}
		}

		if(!empty($jobActiveQuery) && $jobActiveQuery !== 'All'){
			if(!$hasFirstParamBefore){
				$sql .=	" where activeFlg = :activeFlg";
				$hasFirstParamBefore = true;
			}else{
				$sql .=	" or activeFlg = :activeFlg";
			}
		}

// 		$sql .=	" limit {$limitFirst},{$limitLast}";
		$sql .=	" limit {$limitFirst},{$limitRow}";
		// echo $sql;
		// exit;
		// echo "sql = " . $sql;
		// echo "<br/>$jobActiveQuery = " . $jobActiveQuery;
		prnt($debug, 'SQL select * : ' . $sql);
		$stmt = $conPDO->prepare($sql);
		if(!empty($jobName)) $stmt->bindValue(':jobname', "%$jobName%", PDO::PARAM_STR);
		if(!empty($jobActiveQuery) && $jobActiveQuery !== 'All') $stmt->bindValue(':activeFlg', $jobActiveQuery, PDO::PARAM_STR);
		// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
		// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
		try{
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
		    echo 'Connection failed 2: ' . $e->getMessage();
		    $arrOut['err'] = 'Connection failed 2: ' . $e->getMessage();
		    exit;
		}
		// End Query job ############################################

		if(!empty($rows)){
			prnt($debug, '!empty($rows)');
			prnt($debug, '$rows size: ' . count($rows));
			$mapActiveFlg = array('Y'=>'แสดง', 'N'=>'ไม่แสดง');
			// echo 'not empty';
			// echo "<table id='tblResultQueryJob' style='color:blue'>";
			// echo "<table id='tblResultQueryJob' border='1'>";
// 			ob_start();
		?>

		<div id="paginationdemo" class="demo" style="background-color:transparent;border:0;">
		<script>
// 		$('#tblResultQueryJob .btnEditJobRow').click(function(event){
		$('.btnEditJobRow').click(function(event){
			//alert(111);
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
				}
			});

			$('#divEditJob').css({'display':'block'});
			var jsonData = {jobName:jobName, jobDetail:jobDetail, jobAmount:jobAmount,
							jobActiveFlg:jobActiveFlg};
			jobNameForEdit = jobName;
			$('#jobNameEdit').val(jobName);
			$('#jobDetailEdit').val(jobDetail);
			$('#jobAmountEdit').val(jobAmount);
			$('#jobActiveEdit').val(jobActiveFlg);
			$('#editFromPageNumber').val(<?php echo $currentPage ?>);
		});
		</script>
<?php
		//echo "<table id='tblResultQueryJob' class='table'>";
		echo "<table class='table table-striped table-bordered '>";
		echo "<tr>";
		echo "<th>ชื่อตำแหน่ง</th>";
		echo "<th>รายละเอียด</th>";
		echo "<th>จำนวนที่ต้องการ</th>";
		echo "<th>การแสดงผล</th>";
		echo "<th>แก้ไข</th>";
		echo "<th>ลบ</th>";
		echo "</tr>";
		foreach ($rows as $row) {
		    // echo "{$row['jobname']}";
		    echo "<tr>";
			echo "<td>{$row['jobname']}</td>";
			echo "<td>{$row['detail']}</td>";
			echo "<td class='alignRight'>{$row['amount']}</td>";

			echo "<td>";
?>
			<?php //echo "<option value='{$row['activeFlg']}'>".$mapActiveFlg[$row['activeFlg']]."</option>"; 
				echo $mapActiveFlg[$row['activeFlg']];
			?>
<?php
			echo "</td>";?>
			<td><button class="btnEditJobRow btn btn-default btn-sm">แก้ไข</button>
			</td>
			<td><button class="btnDeleteJobRow btn btn-default btn-sm">ลบ</button>
			</td>

<?php		echo "</tr>";

		}
		echo "</table>";
?>
			<div id="demo5" style="margin-top: 5px;">                   
   			</div>
		</div>

		<script>
			$("#demo5").paginate({
				count 		: <?php echo $totalPage; ?>,
				start 		: <?php echo $currentPage ?>,
				display     : <?php echo $limitRow ?>,
				border					: false,
				text_color  			: '#888',
				background_color    	: '#EEE',	
				border_hover_color		: '#ccc',	
				text_hover_color  		: 'black',
				background_hover_color	: '#CFCFCF',
				onChange     			: function(page){
										  		event.preventDefault();

												var url='/nommali/job/queryJob.php';
												var data={currentPage:page,changePaging:'true'};

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
			});
		</script>
<?php
// 			$output = ob_get_contents();
// 			$arrOut['successMsg'] = $output;
// 			ob_end_clean();
// 			echo json_encode($arrOut);
		}else{
			echo '<h4 style="color:red;">ไม่พบข้อมูล</h4>';
		}
		// var_dump($rows);

		$hasPosition = false;
	}
	
?>