<?php
include "../head.php";
include "userGroup.php";
require "user.php";
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "update") {
        if(!$dataBase->updateUserUserGroup($_POST['emailV'], $_POST['userGroup'])){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The user could not be updated.";
            header("Location: ../index.php");
            exit;
        }

        $user = unserialize($_SESSION["user"]);
        $user->setIdUserGroup($_POST['userGroup']);
        $_SESSION["user"] = serialize($user);
        
        header("Location: ../myAccount.php?page=myUsers.php");
        exit;

    } else if ($_POST["action"] === "add") {
        $user = new User($_POST['realName'],$_POST['realSurname'], $_POST['email'], $_POST['password'], $_POST['userGroup']);

        if (!$dataBase->insertUser($user)) {
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The user could not be created.";
            header("Location: ../index.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myUsers.php");
        exit;
    } else if ($_POST["action"] === "remove") {
        if (!$dataBase->deleteUser($_POST['emailV'])) {
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The user could not be deleted.";
            header("Location: ../index.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myUsers.php");
        exit;
    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the user.";
    header("Location: ../index.php");
}