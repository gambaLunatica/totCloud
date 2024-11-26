<?php
require "dataBase.php";
require "company.php";
require "userGroup.php";
require("user.php");

include "error.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // get the values from the form
    $companyName = htmlspecialchars($_POST['companyName'] ?? '', ENT_QUOTES, 'UTF-8');
    $region = htmlspecialchars($_POST['region'] ?? '', ENT_QUOTES, 'UTF-8');
    $realName = htmlspecialchars($_POST['realName'] ?? '', ENT_QUOTES, 'UTF-8');
    $realSurname = htmlspecialchars($_POST['realSurname'] ?? '', ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
//TODO
    $company = new Company($region, $companyName);
    if(!$dataBase->insertCompany($company)){
        displayError("The company already exists.");
        exit;
    } else{

    }

    $userGroup = new UserGroup($company->getId(), "Administrators");
    $dataBase->insertUserGroup($userGroup);

    //password se encripta en el constructor
    $user = new User($username, $realName, $realSurname, $email, $password, $userGroup->getId(), $company->getId());
    if($dataBase->insertUser($user)){
        displayError("The username or email already exists");
        exit;
    }

    $_SESSION["user"] = $user;
    header("Location: ../index.php");
exit;

}