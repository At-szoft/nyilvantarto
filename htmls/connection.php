<?php
	$con = false;
	
	function ConDb(){
		global $con;
		$con=mysql_connect("localhost","santaclaus","artic");		
		$mdb=mysql_select_db("infodb",$con);
		mysql_query('SET NAMES utf8');
	}

	function ClsConDb(){
		global $con;
		mysql_close($con);
	}
?>