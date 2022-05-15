<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){
		$id = $_POST['id'];
		$firstname = $_POST['name'];
		$lastname = $_POST['party'];
		$position = $_POST['email'];

		$sql = "UPDATE candidates SET name = '$name', party = '$party', email = '$email' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: candidates.php');

?>