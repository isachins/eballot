<?php
include_once 'include/config.php';
if(isset($_POST['save']))
{	 
	 $first_name = $_POST['name'];
	 $last_name = $_POST['description'];
	 $sql = "INSERT INTO position (name,description)
	 VALUES ('$name','$description')";
	 if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
        header("location: position.php");

	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>