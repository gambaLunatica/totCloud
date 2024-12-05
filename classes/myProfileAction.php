<?php
require("../head.php");
require "dataBase.php";

require "user.php";



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];

    if ($name === "" || $surname === "" || $email === "") {
        $_SESSION["error"] = 1;
        $_SESSION["message"] = "The profile was not updated, fields were incomplete.";
        header("Location: ../index.php");
        exit;
    }

    if (($cpassword === $password) === false) {
        $_SESSION["error"] = 1;
        $_SESSION["message"] = "The profile was not updated, the passwords did not match.";
        header("Location: ../index.php");
        exit;
    }

    $user = unserialize($_SESSION["user"]);
    $user->setRealName($name);
    $user->setRealSurname($surname);


    if(($password === '') === false){
        $user->setPassword($password);
    }

    if($dataBase->updateUser($user)){
        $_SESSION["user"] = serialize($user);
    } else{
        $_SESSION["error"] = 1;
        $_SESSION["message"] = "Severe error when updating the user.";
        header("Location: ../index.php");
        exit;
    }


    header("Location: ../myAccount.php?page=myProfile.php");

    exit;

}