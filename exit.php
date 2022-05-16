<?php

require_once "include/session.php";




$sql = "TRUNCATE TABLE candidates";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}

	$sql = "TRUNCATE TABLE election_name";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}

	$sql = "TRUNCATE TABLE voters";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
    header('location: dashboard.php');
    ?>
