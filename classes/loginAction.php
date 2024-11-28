<?php
require "company.php";
require "userGroup.php";
require "user.php";

require "../index.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // get the values from the form
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
//TODO
    $user = new User(null, null, $email, $password, -1, null);

    $user = $dataBase->getUser($user);
    if($user == null){
        $_SESSION["error"] = 1;
        $_SESSION["message"] = "Wrong email or password.";
        header("Location: ../index.php");
        exit;
    }

    $_SESSION["user"] = $user;
    header("Location: ../index.php");
    
exit;

}