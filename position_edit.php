

<?php
require_once "include/config.php";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $u_description = $_POST['u_description'];
    $u_name = $_POST['u_name'];

    $sql = "UPDATE position SET description = '$u_description', name = '$u_name' WHERE id = '$id'";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Position updated successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: position.php');

?>


