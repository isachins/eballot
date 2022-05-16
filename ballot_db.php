
<?php
require_once "include/config.php";

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: user.php");
}
	if(isset($_POST['submit'])){
		$party = $_POST['email'];
		$position = $_POST['party'];
		$email = $_POST['vote'];

        $sql = "INSERT INTO result (email, party, vote) VALUES ('$email', '$party', '$vote')";
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