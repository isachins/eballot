<?php


session_start();
require_once "include/session.php";


error_reporting(0);


$ts_email=$_GET['email'];
$query = "DELETE FROM VOTERS WHERE TS_EMAIL = '$ts_email'";

$data=mysqli_query($conn, $query);

if($data)
{
    echo "Record deleted from database";
}
else{
    echo " Failed to delete data";
}
header('location: voters.php');

?>