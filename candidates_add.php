<?php
require_once "include/session.php";

	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$party = $_POST['party'];
		$position = $_POST['position'];
		$email = $_POST['email'];

		$sql = "INSERT INTO candidates (position, name, party, email) VALUES ('$position', '$name', '$party', '$email')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: candidates.php');
?>