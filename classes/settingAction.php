<?php
require("../head.php");
require("setting.php");
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
     if ($_POST["action"] === "remove") {
        if (($_POST["idSetting"] === "--New--") == false) {

            if (!$dataBase->deleteSetting($_POST["idSetting"])) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The setting could not be deleted.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myConsole.php");
        exit;

    } else if ($_POST["action"] === "add") {
        if (($_POST["idSetting"] === "--New--") == false) {
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "Data Base Settings cannot be edited. Remove it and add it again.";
            header("Location: ../index.php");
            exit;
        } else {
            if (
                $_POST["stringValue"] === "" && $_POST["booleanValue"] === "" && $_POST["decimalValue"] === ""
                || $_POST["idDBTypePostgrade"] === "" && $_POST["idDBTypeSQL"] === ""
            ) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The Data Base types or the default values cannot be empty";
                header("Location: ../index.php");
                exit;
            }

            $setting = new Setting(
                $_POST["nameSetting"],
                $_POST["status"],
                $_POST["idDBTypeSQL"]===""?null:$_POST["idDBTypeSQL"],
                $_POST["idDBTypePostgrade"]===""?null:$_POST["idDBTypePostgrade"],
                $_POST["booleanValue"]===""?null:$_POST["booleanValue"],
                $_POST["decimalValue"]===""?null:$_POST["decimalValue"],
                $_POST["stringValue"]===""?null:$_POST["stringValue"]
            );

            if (!$dataBase->insertSetting($setting)) {
                $_SESSION["error"] = 1;
                $_SESSION["message"] = "The setting already exists.";
                header("Location: ../index.php");
                exit;
            }

            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }


    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the setting.";
    header("Location: ../index.php");
}