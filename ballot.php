<?php
require_once "include/config.php";
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: user.php");
}
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
    <!-- You need focus-trap.js to make the modal accessible -->
    <script src="./assets/js/focus-trap.js" defer></script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    a {
        text-decoration: none;
    }

    ul {
        list-style-type: none;
    }

    body {
        font-family: "Poppins", sans-serif;
        background: #141432;
        color: #ffffff;
    }

    .radio-section {
        display: flex;
        align-items: center;
        justify-content: center;
        height: auto;
    }

    .radio-item [type="radio"] {
        display: none;
    }

    .radio-item+.radio-item {
        margin-top: 15px;
    }

    .radio-item label {
        display: block;
        padding: 20px 60px;
        background: #1d1d42;
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 400;
        min-width: 250px;
        white-space: nowrap;
        position: relative;
    }

    .radio-item label:after,
    .radio-item label:before {
        content: "";
        position: absolute;
        border-radius: 50%;
    }

    .radio-item label:after {
        height: 20px;
        width: 20px;
        border: 2px solid #524eee;
        left: 20px;
        top: calc(50% - 12px);
    }

    .radio-item label:before {
        background: #524eee;
        height: 10px;
        width: 10px;
        left: 27px;
        top: calc(50% - 5px);
        transform: scale(5);
        transition: .4s ease-in-out 0s;
        opacity: 0;
        visibility: hidden;
    }

    .radio-item [type="radio"]:checked~label {
        border-color: #524eee;
    }

    .radio-item [type="radio"]:checked~label:before {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }
</style>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <div class="flex flex-col flex-1 w-full">
            <!--Navbar starts-->
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                    <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200">
                        eBallot
                    </a>
                    <!-- space between tabs -->
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                        </div>
                    </div>
                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Theme toggler -->
                        <li class="flex">
                            <button class="rounded-md focus:outline-none focus:shadow-outline-purple" @click="toggleTheme" aria-label="Toggle color mode">
                                <template x-if="!dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                        </path>
                                    </svg>
                                </template>
                                <template x-if="dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                    </svg>
                                </template>
                            </button>
                        </li>
                        <!-- Profile menu -->
                        <li class="relative">
                            <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none" @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
                                <img class="object-cover w-8 h-8 rounded-full" src="assets/img/5.png" alt="" aria-hidden="true" />
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="logout.php">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span>Log out</span>
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>
                </div>
            </header>

            <!--Navbar ends-->

            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <section class="bg-white dark:bg-gray-900">
                        <div class="h-[32rem] bg-gray-100 dark:bg-gray-800">
                            <div class='container px-6 py-10 mx-auto'>

                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $database = "eballot";
                                //check connection
                                $connection = new mysqli($servername, $username, $password, $database);
                                // check connection
                                if ($connection->connect_error) {
                                    die("Connection Failed:" . $connection->connect_error);
                                }
                                //read all row from database table
                                $sql = "SELECT * FROM election_name";
                                $result = $connection->query($sql);
                                if (!$result) {
                                    die("Invalid query: " . $connection->error);
                                }
                                //read data of each row
                                if ($row = $result->fetch_assoc()) {
                                    echo " 
                                <h1 class='text-3xl font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white'>
                                " . $row["name"] . "
                                </h1>
                                <div class='flex justify-center mx-auto mt-6'>
                                    <span class='inline-block w-40 h-1 bg-purple-500 rounded-full'></span>
                                    <span class='inline-block w-3 h-1 mx-1 bg-purple-500 rounded-full'></span>
                                    <span class='inline-block w-1 h-1 bg-purple-500 rounded-full'></span>
                                </div>
                                ";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="container px-6 py-10 mx-auto -mt-72 sm:-mt-60  md:-mt-96">
                            <div class=" gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-3">

                                <!--voting ballot-->
                                <form method="POST" action="ballot_db.php">
                                    <div class='flex flex-col items-center p-4 border sm:p-6 rounded-xl dark:border-gray-700'>

                                        <?php
                                        //read all row from database table
                                        $sql = "SELECT * FROM election_name";
                                        $result = $connection->query($sql);

                                        if (!$result) {
                                            die("Invalid query: " . $connection->error);
                                        }
                                        //read data of each row
                                        if ($row = $result->fetch_assoc()) {
                                            echo
                                            " 
                                                    <h1 class='mt-4 text-2xl font-semibold text-gray-700 capitalize dark:text-white'>
                                                        " . $row["name"] . "
                                                    </h1>
                                                    <p class='block max-w-2xl mt-4 text-xl text-gray-500 dark:text-gray-300'> 
                                                        " . $row["description"] . " 
                                                    </p>
                                                ";
                                        }
                                        ?>

                                        <div class='flex justify-center mx-auto mt-6 mb-10'>
                                            <span class='inline-block w-40 h-1 bg-purple-500 rounded-full'></span>
                                            <span class='inline-block w-3 h-1 mx-1 bg-purple-500 rounded-full'></span>
                                            <span class='inline-block w-1 h-1 bg-purple-500 rounded-full'></span>
                                        </div>


                                        <?php

                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $database = "eballot";

                                            //check connection
                                            $connection = new mysqli($servername, $username, $password, $database);

                                            // check connection
                                            if ($connection->connect_error) {
                                                die("Connection Failed:" . $connection->connect_error);
                                            }

                                            //read all row from database table
                                            $sql = "SELECT * FROM candidates";
                                            $result = $connection->query($sql);

                                            if (!$result) {
                                                die("Invalid query: " . $connection->error);
                                            }

                                            //read data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo
                                                "  
                                                    <section class='radio-section mt-2'>
                                                    <div class='radio-list mb-auto'>
                                                            <div class='radio-item'>
                                                                <input type='radio' name='vote' id='" . $row["id"] . "'>
                                                                <label for='" . $row["id"] . "'>" . $row["name"] . " / " . $row["party"] . "</label>
                                                            </div>
                                                        </div>
                                                    </section>
                                                ";
                                            }
                                        ?>

                                        <div class="flex justify-center mt-6">
                                            <button type="button" name="submit" class="inline-flex items-center justify-center mt-8 mb-4 w-32 px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                                submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
            <!--Footer starts-->
            <footer class="flex flex-col items-center justify-between px-6 py-4 bg-white dark:bg-gray-800 sm:flex-row">
                <a href="#" class="text-xl font-bold text-gray-800 dark:text-white hover:text-gray-700 dark:hover:text-gray-300">
                    eBallot
                </a>
                <p class="py-2 text-gray-800 dark:text-white sm:py-0">
                    All rights reserved
                </p>
                <div class="flex -mx-2">
                    <p class="py-2 text-gray-800 dark:text-white sm:py-0"><?php echo $_SESSION['email'] ?></p>
                </div>
            </footer>
            <!--Footer ends-->
        </div>
    </div>
</body>
</html>