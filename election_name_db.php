<?php
include_once 'include/config.php';
if(isset($_POST['save']))
{	 
	 $first_name = $_POST['name'];
	 $sql = "INSERT INTO election_name (name)
	 VALUES ('$name')";
	 if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
        header("location: voters.php");

	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>