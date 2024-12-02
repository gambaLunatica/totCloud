<?php
require ("../head.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $regionName = $_POST['regionName'];

    if($_POST["action"]=== "remove"){
        if(!$dataBase->deleteRegion($regionName)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The region could not be deleted.";
            header("Location: ../index.php");
            exit;
        }
    }else if($_POST["action"]=== "add"){
        if(!$dataBase->insertRegion($regionName)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The region already exists.";
            header("Location: ../index.php");
            exit;
        }
    }

    header("Location: ../myAccount.php?page=myConsole.php");
    
exit;

}