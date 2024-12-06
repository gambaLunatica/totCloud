<?php
include "userGroup.php";
require "user.php";
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "load") {
        if ($_POST["imageId"] === "--New--") {
            header("Location: ../myAccount.php?page=myConsole.php");
            exit;
        }
        $image = $dataBase->selectImage($_POST["imageId"]);

        $statusName = $image->getStatusName();
        $cost = $image->getCost();
        $osName = $image->getOsName();
        $build = $image->getBuild();
        $idImage = $image->getIdImage();

        header("Location: ../myAccount.php?page=myConsole.php&imageId=$idImage&status=$statusName&osName=$osName&cost=$cost&build=$build");
        exit;

    } else if ($_POST["action"] === "remove") {
        if (($_POST["imageId"] === "--New--") == false) {
            $image = new Image($_POST["imageId"], "", 0, "", "");

            if (!$dataBase->deleteImage($image)) {
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
        $userGroup = new UserGroup($dataBase->getCompany(),$_POST["nameUserGroup"]);
        $dataBase->insertUserGroup($userGroup);

        if($dataBase->canEditPrivileges()){
            $dataBase->insertPrivilege($userGroup->getId(), "View Payments", isset($_POST["viewPayments"]) ? true:false);
            $dataBase->insertPrivilege($userGroup->getId(), "Edit Privilegies", isset($_POST["editPrivileges"]) ? true:false);
            $dataBase->insertPrivilege($userGroup->getId(), "Edit User Groups", isset($_POST["editUserGroups"]) ? true:false);
            $dataBase->insertPrivilege($userGroup->getId(), "Edit Users", isset($_POST["editUsers"]) ? true:false);
            $dataBase->insertPrivilege($userGroup->getId(), "Edit Company", isset($_POST["editCompany"]) ? true:false);
            $dataBase->insertPrivilege($userGroup->getId(), "View Data Bases", isset($_POST["viewDataBases"]) ? true:false);
            $dataBase->insertPrivilege($userGroup->getId(), "View Compute Instances", isset($_POST["viewComputeInstances"]) ? true:false);
            $dataBase->insertPrivilege($userGroup->getId(), "View Storage Units", isset($_POST["viewStorages"]) ? true:false);
            $dataBase->insertPrivilege($userGroup->getId(), "View VCNs", isset($_POST["viewVirtualNetworks"]) ? true:false);

            if($dataBase->isSuperAdmin()){
                $dataBase->insertPrivilege($userGroup->getId(), "Super Admin", isset($_POST["superAdmin"]) ? true:false);
            }
        } else{
            $dataBase->insertPrivileges($userGroup->getId(), false);
        }

        header("Location: ../myAccount.php?page=myUserGroups.php");
        exit;
    }


    $_SESSION["error"] = 1;
    $_SESSION["message"] = "Severe error when handling the image.";
    header("Location: ../index.php");
}