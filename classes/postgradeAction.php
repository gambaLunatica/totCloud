<?php
require("../head.php");
require("Postgrade.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "load") {
        if ($_POST["idDBTypePostgrade"] === "--New--") {
            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }
        $postgrade = $dataBase->selectPostgrade($_POST["idDBTypePostgrade"]);

        $statusName = $postgrade->getStatusName();
        $cost = $postgrade->getCost();
        $releaseDate = $postgrade->getReleaseDate()->format('Y-m-d');
        $build = $postgrade->getBuild();
        $idDBType = $postgrade->getIdDBType();

        header("Location: ../myAccount.php?page=myConsole.php&idDBTypePostgrade=$idDBType&status=$statusName&releaseDate=$releaseDate&cost=$cost&build=$build");
        exit;

    } else if ($_POST["action"] === "remove") {
        if (($_POST["idDBTypePostgrade"] === "--New--") == false) {
            if (!$dataBase->deletePostgrade($_POST["idDBTypePostgrade"])) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The Postgrade Data Base Type could not be deleted.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myConsole.php");
        exit;

    } else if ($_POST["action"] === "add") {
        if (($_POST["idDBTypePostgrade"] === "--New--") == false) {
            $postgrade = new Postgrade($_POST["idDBTypePostgrade"], $_POST["status"], $_POST["cost"], new DateTime($_POST["releaseDate"]), $_POST["build"]);

            if (!$dataBase->updatePostgrade($postgrade)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The Postgrade Data Base Type could not be updated.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        } else {
            $postgrade = new Postgrade(-1, $_POST["status"], $_POST["cost"], new DateTime($_POST["releaseDate"]), $_POST["build"]);

            if (!$dataBase->insertPostgrade($postgrade)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The Postgrade Data Base Type already exists.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }


    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the Postgrade Data Base Type.";
    header("Location: ../index.php");
}