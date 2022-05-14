<?php


session_start();
require_once "include/session.php";


error_reporting(0);


$id=$_GET['id'];
$query = "DELETE FROM candidates WHERE id = '$id'";

$data=mysqli_query($conn, $query);

if($data)
{
    echo "Record deleted from database";
}
else{
    echo " Failed to delete data";
}
header('location: candidates.php');

?>