<?php
	require_once 'config.php';
	if(ISSET($_POST['add'])){
		if($_POST['task'] != ""){
			$task = $_POST['task'];
			$consultant = $_POST['cons'];
			$conn->query("INSERT INTO task (`task`, `status`,`Date`, `Consultant`) VALUES ('$task', '', NOW(), '$consultant')");
			header('location:task.php');
		}
	}
?>