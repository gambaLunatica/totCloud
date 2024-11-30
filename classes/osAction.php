<?php
require ("../head.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $os = $_POST['os'];

    if($_POST["action"]=== "remove"){
        if(!$dataBase->deleteOS($os)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The OS could not be deleted.";
            header("Location: ../index.php");
            exit;
        }
    }else if($_POST["action"]=== "add"){
        if(!$dataBase->insertOS($os)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The OS already exists.";
            header("Location: ../index.php");
            exit;
        }
    }

    header("Location: ../myAccount.php?page=myConsole.php");
    
exit;

}