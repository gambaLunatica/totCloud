<?php
include "userGroup.php";
require "user.php";
require "dataBase.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['action'] === "update") {
        if($dataBase->canEditPrivileges()){
            $dataBase->updatePrivilege($_POST['idUserGroup'], "View Payments", isset($_POST["viewPayments"]) ? true:false);
            $dataBase->updatePrivilege($_POST['idUserGroup'], "Edit Privilegies", isset($_POST["editPrivileges"]) ? true:false);
            $dataBase->updatePrivilege($_POST['idUserGroup'], "Edit User Groups", isset($_POST["editUserGroups"]) ? true:false);
            $dataBase->updatePrivilege($_POST['idUserGroup'], "Edit Users", isset($_POST["editUsers"]) ? true:false);
            $dataBase->updatePrivilege($_POST['idUserGroup'], "Edit Company", isset($_POST["editCompany"]) ? true:false);
            $dataBase->updatePrivilege($_POST['idUserGroup'], "View Data Bases", isset($_POST["viewDataBases"]) ? true:false);
            $dataBase->updatePrivilege($_POST['idUserGroup'], "View Compute Instances", isset($_POST["viewComputeInstances"]) ? true:false);
            $dataBase->updatePrivilege($_POST['idUserGroup'], "View Storage Units", isset($_POST["viewStorages"]) ? true:false);
            $dataBase->updatePrivilege($_POST['idUserGroup'], "View VCNs", isset($_POST["viewVirtualNetworks"]) ? true:false);
        }
        header("Location: ../myAccount.php?page=myUserGroups.php");
        exit;

    } else if ($_POST["action"] === "remove") {
        if(!$dataBase->deleteUserGroup($_POST['idUserGroup'])){
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The user group could not be deleted, might still have users assigned.";
            header("Location: ../index.php");
            exit;
        }

        header("Location: ../myAccount.php?page=myUserGroups.php");
        exit;

    } else if ($_POST["action"] === "add") {
        $userGroup = new UserGroup($dataBase->getCompany(),$_POST["nameUserGroup"]);

        if (!$dataBase->insertUserGroup($userGroup)) {
            $_SESSION["error"] = 1;
            $_SESSION["message"] = "The user group could not be created.";
            header("Location: ../index.php");
            exit;
        }

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