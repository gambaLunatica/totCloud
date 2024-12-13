<?php
require 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idVCN = htmlspecialchars($_POST['idVCN']);
    
    try {

        $deleteQuery = "DELETE FROM MyUsage WHERE idVCN = ?";
        $deleteStmt = $dataBase->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $idVCN);
        $success = $deleteStmt->execute();

        // Eliminar la VCN
        $deleteQuery = "DELETE FROM VCN WHERE idVCN = ?";
        $deleteStmt = $dataBase->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $idVCN);
        $success = $deleteStmt->execute();

        if ($success) {
            echo "VCN deleted successfully.";
        } else {
            throw new Exception("Error deleting VCN: ");
            exit;
        }
    } catch (Exception $e) {
        echo "VCN has associated subnets and cannot be deleted.";
    }
} else {
    echo "Invalid request method.";
}
?>
