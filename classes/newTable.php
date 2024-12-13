<?php
include "dataBase.php";
include "user.php";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $idTable = $_GET['idTable'] ?? null;
    $mode = $_GET['mode'] ?? null;
    $idDataBase = $_GET['idDataBase'] ?? null;

    if($mode === 'edit'){
        $nameTable = $_GET['updateName'];
        $queryUpdate = "UPDATE MyTable SET nameTable = ? WHERE idTable = ?";
        $stmtUpdate = $dataBase->prepare($queryUpdate);
        $stmtUpdate->bind_param("si", $nameTable, $idTable);
        if($stmtUpdate->execute()){
            header("Location: ../dbDetail.php"); 
        }else{
            echo "Error updating table";
        }

    }else if($mode === 'delete'){
        $queryDelete = "DELETE FROM MyTable WHERE idTable = ?";
        $stmtDelete = $dataBase->prepare($queryDelete);
        $stmtDelete->bind_param("i", $idTable);
        if($stmtDelete->execute()){
            header("Location: userDB.php");
        }else{
            echo "Error deleting table";
        }
    }else if($mode === 'create'){
        $nameTable = $_GET['newTableName'];
        $queryCreate = "INSERT INTO MyTable (nameTable, idDataBase) VALUES (?, ?)";
        $stmtCreate = $dataBase->prepare($queryCreate);
        $stmtCreate->bind_param("si", $nameTable, $idDataBase);
        if($stmtCreate->execute()){
            header("Location: ../userDB.php");
        }else{
            echo "Error creating table";
        }
    }
}