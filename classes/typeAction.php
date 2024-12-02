<?php
require ("../head.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $type = $_POST['type'];

    if($_POST["action"]=== "remove"){
        if(!$dataBase->deleteType($type)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The type could not be deleted.";
            header("Location: ../index.php");
            exit;
        }
    }else if($_POST["action"]=== "add"){
        if(!$dataBase->insertType($type)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The type already exists.";
            header("Location: ../index.php");
            exit;
        }
    }

    header("Location: ../myAccount.php?page=myConsole.php");
    
exit;

}