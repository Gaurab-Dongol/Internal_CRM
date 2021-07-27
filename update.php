<?php
	require_once 'config.php';
	
	if($_GET['Id'] != ""){
		$id = $_GET['Id'];
		
		$conn->query("UPDATE OfficeHQ SET status = 'Done' WHERE Id = $d") or die(mysqli_errno());
		header('location: index.php');
	}
?>