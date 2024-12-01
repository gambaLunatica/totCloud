<?php
require("../head.php");
require("memory.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "load") {
        if ($_POST["idMemory"] === "--New--") {
            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }
        $memory = $dataBase->selectMemory($_POST["idMemory"]);

        $statusName = $memory->getStatusName();
        $cost = $memory->getCost();
        $totalCapacity = $memory->getTotalCapacity();
        $IOSpeed = $memory->getIOSpeed();
        $idMemory = $memory->getIdMemory();
        $generation = $memory->getGeneration();

        header("Location: ../myAccount.php?page=myConsole.php&idMemory=$idMemory&status=$statusName&totalCapacity=$totalCapacity&cost=$cost&IOSpeed=$IOSpeed&generation=$generation");
        exit;

    } else if ($_POST["action"] === "remove") {
        if (($_POST["idMemory"] === "--New--") == false) {
            $memory = new Memory($_POST["idMemory"], "", 0, "", "", "");

            if (!$dataBase->deleteMemory($memory)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The memory could not be deleted.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myConsole.php");
        exit;

    } else if ($_POST["action"] === "add") {
        if (($_POST["idMemory"] === "--New--") == false) {
            $memory = new Memory($_POST["idMemory"], $_POST["status"], $_POST["totalCapacity"], $_POST["IOSpeed"], $_POST["generation"], $_POST["cost"]);

            if (!$dataBase->updateMemory($memory)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The memory could not be updated.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        } else {
            $memory = new Memory(-1, $_POST["status"], $_POST["totalCapacity"], $_POST["IOSpeed"], $_POST["generation"], $_POST["cost"]);

            if (!$dataBase->insertMemory($memory)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The memory already exists.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }


    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the image.";
    header("Location: ../index.php");
}