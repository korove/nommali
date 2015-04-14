<?php
	function validateInputData($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = strip_tags($data);
	  $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
	  return $data;
	}
?>