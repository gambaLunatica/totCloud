<?php
require "company.php";
require "userGroup.php";
require "user.php";

require "../index.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // get the values from the form
    $companyName = htmlspecialchars($_POST['companyName'] ?? '', ENT_QUOTES, 'UTF-8');
    $region = htmlspecialchars($_POST['region'] ?? '', ENT_QUOTES, 'UTF-8');
    $realName = htmlspecialchars($_POST['realName'] ?? '', ENT_QUOTES, 'UTF-8');
    $realSurname = htmlspecialchars($_POST['realSurname'] ?? '', ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
//TODO
    $company = new Company($companyName, $region);
    $user = new User($realName, $realSurname, $email, $password, -1, $companyName);

    $idUserGroup = $dataBase->insertCompany($company, $user);
    if($idUserGroup == -1){
        $_SESSION["error"] = 1;
        $_SESSION["message"] = "The company or username already exist.";
        header("Location: ../index.php");
        exit;
    }
    
    $user->setIdUserGroup($idUserGroup);

    $_SESSION["user"] = $user;
    header("Location: ../index.php");
    
exit;

}