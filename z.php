
<?php
session_start();

require_once('include/config.php');
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = $connection->prepare("SELECT * FROM voters WHERE email=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo '<p class="error">email password combination is wrong!</p>';
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['email'] = $result['id'];
            $check_email = mysqli_query($conn, "SELECT email FROM result where email = '$email' ");
            if (mysqli_num_rows($check_email) > 0) {
                header("location: submitted.php");
                exit;
            } else {
                header("location: ballot.php");
                exit;
            }
        } else {
            echo '<p class="error">email password combination is wrong!</p>';
        }
    }
}

?>