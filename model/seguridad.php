<?php
	session_start();
	$aut = isset($_SESSION["aut"]) ? $_SESSION["aut"]:NULL;
	if(session_status()!=2 or $aut!="ññ"){
		session_destroy();
		header("Location: index.php");
		exit();
	}
?>