<?php
require_once "include/session.php";

	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$party = $_POST['email'];
		$position = $_POST['party'];
		$email = $_POST['vote'];

        $sql = "INSERT INTO result (name, email, party, vote) VALUES ('$name', '$email', '$party', '$vote')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select one option first';
	}

	header('location: submitted.php');
?>