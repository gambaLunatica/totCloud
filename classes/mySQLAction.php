<?php
require("../head.php");
require("MySQL.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "load") {
        if ($_POST["idDBTypeSQL"] === "--New--") {
            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }
        $mySQL = $dataBase->selectMySQL($_POST["idDBTypeSQL"]);

        $statusName = $mySQL->getStatusName();
        $cost = $mySQL->getCost();
        $releaseDate = $mySQL->getReleaseDate()->format('Y-m-d');
        $version = $mySQL->getVersion();
        $idDBType = $mySQL->getIdDBType();

        header("Location: ../myAccount.php?page=myConsole.php&idDBTypeSQL=$idDBType&status=$statusName&releaseDate=$releaseDate&cost=$cost&version='$version'");
        exit;

    } else if ($_POST["action"] === "remove") {
        if (($_POST["idDBTypeSQL"] === "--New--") == false) {
            if (!$dataBase->deleteMySQL($_POST["idDBTypeSQL"])) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The MySQL Data Base Type could not be deleted.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myConsole.php");
        exit;

    } else if ($_POST["action"] === "add") {
        if (($_POST["idDBTypeSQL"] === "--New--") == false) {
            $mySQL = new MySQL($_POST["idDBTypeSQL"], $_POST["status"], $_POST["cost"], new DateTime($_POST["releaseDate"]), $_POST["version"]);

            if (!$dataBase->updateMySQL($mySQL)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The MySQL Data Base Type could not be updated.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        } else {
            $mySQL = new MySQL(-1, $_POST["status"], $_POST["cost"], new DateTime($_POST["releaseDate"]), $_POST["version"]);

            if (!$dataBase->insertMySQL($mySQL)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The MySQL Data Base Type already exists.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }


    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the MySQL Data Base Type.";
    header("Location: ../index.php");
}