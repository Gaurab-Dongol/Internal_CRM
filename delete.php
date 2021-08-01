<?php
	require_once 'config.php';
	
	if($_GET['id']){
		$id = $_GET['id'];
		
		$connect->query("DELETE FROM `OfficeHQ` WHERE `id` = $id") or die(mysqli_errno());
		header("location: index.php");
	}	
?>