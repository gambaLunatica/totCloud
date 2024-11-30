<?php
require ("../head.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $series = $_POST['series'];

    if($_POST["action"]=== "remove"){
        if(!$dataBase->deleteSeries($series)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The series could not be deleted.";
            header("Location: ../index.php");
            exit;
        }
    }else if($_POST["action"]=== "add"){
        if(!$dataBase->insertSeries($series)){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The series already exists.";
            header("Location: ../index.php");
            exit;
        }
    }

    header("Location: ../myAccount.php?page=myConsole.php");
    
exit;

}