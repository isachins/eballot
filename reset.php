<?php
require_once "include/session.php";

$sql = "TRUNCATE TABLE result";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
    header('location: dashboard.php');
?>