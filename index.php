<?php
session_start();
session_unset();

require "classes/dataBase.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TotCloud</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file -->
    <link rel="icon" href="totCloud.ico"> <!-- Optional favicon -->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a603bf3adf.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="topnav">
        <ul>
            <li><a class="navbutton" href="#">Virtual Machines</a></li>
            <li><a class="navbutton" href="#">Storages</a></li>
            <li><a class="navbutton" href="#">Data Bases</a></li>
            <li><a class="navbutton" href="#">Virtual Networks</a></li>
        </ul>

        <div>
            <?php if (isset($_SESSION["user"])): ?>
                <div>
                    <a href="#" class="navbutton navuser">
                        <i class="fa-solid fa-user"></i>
                        <lable>My Account</lable>
                    </a>
                </div>
            <?php else: ?>
                <div >
                    <a href="#" class="navbutton navuser">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <lable>Log In</lable>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>