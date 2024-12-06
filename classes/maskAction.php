<?php
require("../head.php");
require("mask.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "load") {
        if ($_POST["cidrId"] === "--New--") {
            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }
        $mask = $dataBase->selectMask((int)$_POST["cidrId"]);

        $cidr = $mask->getCidr();
        $cost = $mask->getCost();

        header("Location: ../myAccount.php?page=myConsole.php&cidr=$cidr&cost=$cost");
        exit;

    } else if ($_POST["action"] === "remove") {
        if (($_POST["cidrId"] === "--New--") == false) {

            if (!$dataBase->deleteMask($_POST["cidr"])) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The mask could not be deleted.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myConsole.php");
        exit;

    } else if ($_POST["action"] === "add") {
        $mask = new Mask($_POST["cost"], $_POST["cidr"]);
        if (($_POST["cidrId"] === "--New--") == false) {
            

            if (!$dataBase->updateMask($mask)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The mask could not be updated.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        } else {

            if (!$dataBase->insertMask($mask)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The mask already exists.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }


    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the mask.";
    header("Location: ../index.php");
}