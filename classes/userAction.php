<?php
include "../head.php";
include "userGroup.php";
require "user.php";
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "update") {
        
        header("Location: ../myAccount.php?page=myUserGroups.php");
        exit;

    } else if ($_POST["action"] === "remove") {
        if(!$dataBase->deleteUserGroup($_POST['idUserGroup'])){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The user group could not be deleted, might still have users assigned.";
            header("Location: ../index.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myUserGroups.php");
        exit;

    } else if ($_POST["action"] === "add") {
        $user = new User($_POST['realName'],$_POST['realSurname'], $_POST['email'], $_POST['password'], $_POST['userGroup']);

        if (!$dataBase->insertUser($user)) {
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The user could not be created.";
            header("Location: ../index.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myUserGroups.php");
        exit;
    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the image.";
    header("Location: ../index.php");
}