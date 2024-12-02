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
        $CPU = $dataBase->selectCPU($_POST["cpu"]);

        $statusName = $CPU->getStatusName();
        $coreCount = $CPU->getCoreCount();
        $cacheL1 = $CPU->getCacheL1();
        $cacheL2 = $CPU->getCacheL2();
        $cacheL3 = $CPU->getCacheL3();
        $frequency = $CPU->getFrequency();
        $cost = $CPU->getCost();
        $model = $CPU->getModel();
        $series = $CPU->getSeries();

        $memories = $dataBase->selectMemoryCompatibility($model);
        $images = $dataBase->selectImageCompatibility($model);

        $queryMemories = http_build_query(['idMemories' => $memories]);
        $queryImages = http_build_query(['idImages' => $images]);

        header("Location: ../myAccount.php?page=myConsole.php&cpu=$model&model=$model&serie=$series&coreCount=$coreCount&frequency=$frequency&cachel1=$cacheL1&cachel2=$cacheL2&cachel3=$cacheL3&status=$statusName&cost=$cost&$queryMemories&$queryImages");
        exit;

    } else if ($_POST["action"] === "remove") {
        if (($_POST["cpu"] === "--New--") == false) {

            if (!$dataBase->deleteCPU($_POST["cpu"])) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The CPU could not be deleted.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myConsole.php");
        exit;

    } else if ($_POST["action"] === "add") {
        if (($_POST["cpu"] === "--New--") == false) {
            $cpu = new CPU(
                $_POST["model"],
                $_POST["serie"],
                $_POST["status"],
                $_POST["coreCount"],
                $_POST["cachel1"],
                $_POST["cachel2"],
                $_POST["cachel3"],
                $_POST["frequency"],
                $_POST["cost"],
                $_POST["idMemories"],
                $_POST["idImages"]
            );

            if (!$dataBase->updateCPU($cpu)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The CPU could not be updated.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        } else {
            $cpu = new CPU(
                $_POST["model"],
                $_POST["serie"],
                $_POST["status"],
                $_POST["coreCount"],
                $_POST["cachel1"],
                $_POST["cachel2"],
                $_POST["cachel3"],
                $_POST["frequency"],
                $_POST["cost"],
                $_POST["idMemories"],
                $_POST["idImages"]
            );

            if (!$dataBase->insertCPU($cpu)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The CPU already exists.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }


    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the CPU.";
    header("Location: ../index.php");
}