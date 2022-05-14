<?php
require_once "include/session.php";

	if(isset($_POST['submit'])){
        $name = $_POST['name'];
		$description = $_POST['description'];
		

		$sql = "SELECT * FROM position ORDER BY priority DESC LIMIT 1";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		$priority = $row['priority'] + 1;
		
		$sql = "INSERT INTO position (name, description, priority) VALUES ('$name', '$description', '$priority')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: position.php');
?>