
<?php
require_once "include/session.php";



if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$position = $_POST['position'];
	$description = $_POST['description'];



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


	$sql = "INSERT INTO election_name (name, position, description) VALUES ('$name', '$position', '$description')";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Candidate added successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
} else {
	$_SESSION['error'] = 'Fill up add form first';
}

header('location: voters.php');
?>