<?php
//This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['email'])) {
    header("location: user.php");
    exit;
}
require_once "include/config.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
        $err = "Please enter email + password";
    } else {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }


    if (empty($err)) {
        $sql = "SELECT email, password FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;


        // Try to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $email, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        // this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["id"] = $password;
                        $_SESSION["loggedin"] = true;

                        //Redirect user to welcome page
                        $check_email = mysqli_query($conn, "SELECT email FROM voters where email = '$email' ");
                        if (mysqli_num_rows($check_email) > 0) {
                            //Redirect user to welcome page
                            $check_email = mysqli_query($conn, "SELECT email FROM result where email = '$email' ");
                            if (mysqli_num_rows($check_email) > 0) {
                                header("location: submitted.php");
                                exit;
                            } else {
                                header("location: ballot.php");
                                exit;
                            }
                        } else {
                            header("location: user.php");
                            exit;
                        }
                    }
                }
            }
        }
    }
}


?>




<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Set Up Election</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
    <!-- You need focus-trap.js to make the modal accessible -->
    <script src="./assets/js/focus-trap.js" defer></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#0ed3cf">
    <meta name="msapplication-TileColor" content="#0ed3cf">
    <meta name="theme-color" content="#0ed3cf">

    <meta property="og:image" content="https://tailwindcomponents.com/storage/799/temp75559.png?v=2022-04-30 10:26:59" />
    <meta property="og:image:width" content="1280" />
    <meta property="og:image:height" content="640" />
    <meta property="og:image:type" content="image/png" />

    <meta property="og:url" content="https://tailwindcomponents.com/component/sign-up-form/landing" />
    <meta property="og:title" content="Sign Up Form by shubhamjainco" />
    <meta property="og:description" content="A Sign Up Form for Tailwind CCSS" />

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@TwComponents" />
    <meta name="twitter:title" content="Sign Up Form by shubhamjainco" />
    <meta name="twitter:description" content="A Sign Up Form for Tailwind CCSS" />
    <meta name="twitter:image" content="https://tailwindcomponents.com/storage/799/temp75559.png?v=2022-04-30 10:26:59" />

    <title>Log In Form . </title>

    <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">
    <div class="bg-grey-lighter min-h-screen flex flex-col">
        <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                <div class="w-full">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                        Login as Voter
                    </h1>
                    <form action="" method="POST">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input placeholder="example@email.com" type="email" name="email" id="email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Password</span>
                            <input placeholder="password" type="password" name="password" id="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                        </label>

                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <button type="submit" value="submit" name="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Log in
                        </button>
                    </form>
                    <hr class="my-8" />
                    <p class="mt-4">
                        <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="forgot-pass.php">
                            Forgot your password?
                        </a>
                    </p>
                    <p class="mt-1">
                        <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="signup.php">
                            Create account
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>