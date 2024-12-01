<?php
require ("../head.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $generation = $_POST['generation'];

    if($_POST["action"]=== "remove"){
        if(!$dataBase->deleteGeneration($generation)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The generation could not be deleted.";
            header("Location: ../index.php");
            exit;
        }
    }else if($_POST["action"]=== "add"){
        if(!$dataBase->insertGeneration($generation)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The generation already exists.";
            header("Location: ../index.php");
            exit;
        }
    }

    header("Location: ../myAccount.php?page=myConsole.php");
    
exit;

}