<?php
	require_once 'config.php';
	
	if($_GET['task_id']){
		$task_id = $_GET['task_id'];
		
		$connect->query("DELETE FROM `task` WHERE `task_id` = $task_id") or die(mysqli_errno());
		header("location: task.php");
	}	
?>