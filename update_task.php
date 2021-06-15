<?php
	require_once 'config.php';
	
	if($_GET['task_id'] != ""){
		$task_id = $_GET['task_id'];
		
		$conn->query("UPDATE task SET status = 'Done' WHERE task_id = $task_id") or die(mysqli_errno());
		header('location: task.php');
	}
?>