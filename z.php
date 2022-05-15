


<?php
session_start();


require_once "include/session.php";
$check_email = mysqli_query($conn, "SELECT email FROM result where email = '$email' ");
if (mysqli_num_rows($check_email) > 0) {
    echo ('Email Already exists');
    header("location: submitted.php");
} else {
    echo ('Record Entered Successfully');
    header("location: ballot.php");
}
?>

