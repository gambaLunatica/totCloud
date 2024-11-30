<?php
require ("../head.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST['action']==="load"){

    } else if($_POST["action"]=== "remove"){

    }else if($_POST["action"]=== "add"){

    }




    // get the values from the form
    $series = htmlspecialchars($_POST['series'] ?? '', ENT_QUOTES, 'UTF-8');

    if(!$dataBase->insertSeries($series)){
        $_SESSION["error"] = 1;
        $_SESSION["message"] = "The series already exists";
        header("Location: ../index.php");
        exit;
    }

    header("Location: ../myAccount.php?page=myConsole.php");
    
exit;

}