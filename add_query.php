<?php
	require_once 'config.php';
	if(ISSET($_POST['add'])){
		if($_POST['task'] != ""){
			$task = $_POST['task'];
			$conn->query("INSERT INTO task (`task`, `status`) VALUES ('$task', '')");
			header('location:task.php');
		}
	}
?>