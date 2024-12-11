<?php
require 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idStorageUnit = htmlspecialchars($_POST['idStorageUnit']);
    
    try {
        // Verificar si la VCN tiene subnets asociadas
        /*$query = "SELECT COUNT(*) as count FROM Subnet WHERE idVCN = ?";
        $stmt = $dataBase->prepare($query);
        $stmt->bind_param("i", $idVCN);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            echo "VCN has associated subnets and cannot be deleted.";
            exit();
        }*/

        // Eliminar la VCN
        $deleteQuery = "DELETE FROM StorageUnit WHERE idStorageUnit = ?";
        $deleteStmt = $dataBase->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $idStorageUnit);
        $success = $deleteStmt->execute();

        if ($success) {
            echo "Storage Unit deleted successfully.";
        } else {
            throw new Exception("Error deleting Storage Unit: ");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
