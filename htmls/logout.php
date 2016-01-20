<?php
	if($_SESSION['valid'] != 1){
		echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
	}
	session_destroy();
	header("Refresh:0");
?>