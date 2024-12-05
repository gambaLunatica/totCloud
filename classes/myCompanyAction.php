<?php
require("../head.php");
require "dataBase.php";

require "user.php";
require "userGroup.php";
require "company.php";



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $region = $_POST['region'];

    $user = unserialize($_SESSION["user"]);
    $userGroup = $dataBase->selectUserGroup($user->getIdUserGroup());
    $originalName = $userGroup->getNameCompany();

    $newCompany = new Company($originalName, $region);

    if(!$dataBase->updateCompany($newCompany)){
        $_SESSION["error"] = 1;
        $_SESSION["message"] = "Severe error when updating the company.";
        header("Location: ../index.php");
        exit;
    }


    header("Location: ../myAccount.php?page=myProfile.php");

    exit;

}