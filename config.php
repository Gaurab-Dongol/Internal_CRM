<?php
session_start(); // we will use it later  to store logged in user information such as username
define("HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "Internal_CRM");
$connect = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
if (!$connect) {
	die(mysqli_error());
}

//$connect = new PDO("mysqli:host=localhost;dbname=Internal_CRM", "root", "root");

function getUserAccessRoleByID($id)
{
	global $connnect;

	$query = "select RoleId from login where RoleId = " . $id;

	$rs = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($rs);

	return $row['RoleId'];
}
