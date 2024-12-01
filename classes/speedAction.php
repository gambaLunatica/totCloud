<?php
require ("../head.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $speed = $_POST['speed'];

    if($_POST["action"]=== "remove"){
        if(!$dataBase->deleteSpeed($speed)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The speed could not be deleted.";
            header("Location: ../index.php");
            exit;
        }
    }else if($_POST["action"]=== "add"){
        if(!$dataBase->insertSpeed($speed)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The speed already exists.";
            header("Location: ../index.php");
            exit;
        }
    }

    header("Location: ../myAccount.php?page=myConsole.php");
    
exit;

}