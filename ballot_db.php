
<?php
require_once "include/config.php";

session_start();

	
	if(isset($_POST['submit']))
	{
		$email = $_POST['email'];
		$vote = $_POST['vote'];
		$party = $_POST['party'];

        $sql = "INSERT INTO result (email, vote, party) VALUES (" . $_SESSION['email'] . ", '$vote', '$party')";
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