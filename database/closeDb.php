<?php

try {
	if(isset($conn)){
 		mysqli_close($conn);
	}
} catch (Exception $e) {
    
}

?>