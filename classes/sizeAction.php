<?php
require ("../head.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $size = $_POST['size'];

    if($_POST["action"]=== "remove"){
        if(!$dataBase->deleteSize($size)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The size could not be deleted.";
            header("Location: ../index.php");
            exit;
        }
    }else if($_POST["action"]=== "add"){
        if(!$dataBase->insertSize($size)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The size already exists.";
            header("Location: ../index.php");
            exit;
        }
    }

    header("Location: ../myAccount.php?page=myConsole.php");
    
exit;

}