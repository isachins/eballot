
<?php
require_once "include/session.php";

	if(isset($_POST['submit'])){
		$name = $_POST['election_name'];

		$sql = "INSERT INTO election_name (name) VALUES ('$name')";
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

	header('location: voters.php');
?>