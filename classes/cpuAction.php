<?php
require("../head.php");
require("cpu.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "load") {
        if ($_POST["cpu"] === "--New--") {
            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }
        $CPUs = $dataBase->selectCPUs($_POST["cpu"]);

        $statusName = $image->getStatusName();
        $cost = $image->getCost();
        $osName = $image->getOsName();
        $build = $image->getBuild();
        $idImage = $image->getIdImage();

        header("Location: ../myAccount.php?page=myConsole.php&imageId=$idImage&status=$statusName&osName=$osName&cost=$cost&build=$build");
        exit;

    } else if ($_POST["action"] === "remove") {
        if (($_POST["cpu"] === "--New--") == false) {

            if (!$dataBase->deleteCPU($_POST["cpu"])) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The image could not be deleted.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myConsole.php");
        exit;

    } else if ($_POST["action"] === "add") {
        if (($_POST["imageId"] === "--New--") == false) {
            $image = new Image($_POST["imageId"], $_POST["status"], $_POST["cost"], $_POST["osName"], $_POST["build"]);

            if (!$dataBase->updateImage($image)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The image could not be updated.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        } else {
            $image = new Image(-1, $_POST["status"], $_POST["cost"], $_POST["osName"], $_POST["build"]);

            if (!$dataBase->insertImage($image)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The image already exists.";
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