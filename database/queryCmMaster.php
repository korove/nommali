<?php

function queryCmMasterHome(){
	$sql = " select * from cm_master "
		.  " where display_home = 'Y'"				
	;
	
	global $conPDO;
	$stmt = $conPDO->prepare($sql);
	
	$rows = null;
	try{
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo 'Connection failed 2: ' . $e->getMessage();
		$arrOut['err'] = 'Connection failed 2: ' . $e->getMessage();
		exit;
	}
	
	return $rows;
}

function queryCmMasterOr($c){
	global $debug;
	prnt($debug, '$c->rowid = ' . $c->rowid );
	$rowid = $c->rowid;
	$parRowId = $c->parRowId;
	$topic = $c->topic;
	$detail = $c->detail;
	$image = $c->image;
	$imageThumbnail = $c->imageThumbnail;
	$movie = $c->movie;
	$type = $c->type;
	$displayHome = $c->displayHome;
	$active = $c->active;

	$sql = "select * from cm_master";
	$hasFirstParamBefore = false;

	if(!empty($rowid)){
		if(!$hasFirstParamBefore){
			$sql .=	" where row_id = :rowid";
			$hasFirstParamBefore = true;
		}else{
			$sql .=	" or row_id = :rowid";
		}
	}

	// 		if(!empty($parRowId)){
	// 			if(!$hasFirstParamBefore){
	// 				$sql .=	" where parRowId = :parRowId";
	// 				$hasFirstParamBefore = true;
	// 			}else{
	// 				$sql .=	" or parRowId = :parRowId";
	// 			}
	// 		}
	global $conPDO;
	$stmt = $conPDO->prepare($sql);
	if(!empty($rowid)) $stmt->bindValue(':rowid', "$rowid", PDO::PARAM_STR);

	$rows = null;
	try{
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo 'Connection failed 2: ' . $e->getMessage();
		$arrOut['err'] = 'Connection failed 2: ' . $e->getMessage();
		exit;
	}

	return $rows;
}


?>