<?php
require("../head.php");
require("storage.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "load") {
        if ($_POST["idStorage"] === "--New--") {
            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }
        $storage = $dataBase->selectStorage($_POST["idStorage"]);

        $statusName = $storage->getStatusName();
        $cost = $storage->getCost();
        $totalCapacity = $storage->getTotalCapacity();
        $IOSpeed = $storage->getIOSpeed();
        $nameStorage = $storage->getNameStorage();
        $typeName = $storage->getTypeName();

        header("Location: ../myAccount.php?page=myConsole.php&nameStorage='$nameStorage'&idStorage=$nameStorage&status=$statusName&totalCapacity=$totalCapacity&cost=$cost&IOSpeed=$IOSpeed&typeName=$typeName");
        exit;

    } else if ($_POST["action"] === "remove") {
        if (($_POST["idStorage"] === "--New--") == false) {

            if (!$dataBase->deleteStorage($_POST["idStorage"])) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The storage could not be deleted.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myConsole.php");
        exit;

    } else if ($_POST["action"] === "add") {
        if (($_POST["idStorage"] === "--New--") == false) {
            $storage = new Storage($_POST["totalCapacity"], $_POST["IOSpeed"], $_POST["typeName"], $_POST["idStorage"], 
            $_POST["cost"], $_POST["status"]);

            if (!$dataBase->updateStorage($storage)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The storage could not be updated.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        } else {
            $storage = new Storage($_POST["totalCapacity"], $_POST["IOSpeed"], $_POST["typeName"], $_POST["nameStorage"], 
            $_POST["cost"], $_POST["status"]);
            if (!$dataBase->insertStorage($storage)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The storage already exists.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }


    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the storage.";
    header("Location: ../index.php");
}