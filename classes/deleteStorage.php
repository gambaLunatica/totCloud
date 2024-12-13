<?php
require 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idStorageUnit = htmlspecialchars($_POST['idStorageUnit']);
    
    try {

        $deleteQuery = "DELETE FROM MyUsage WHERE idStorageUnit = ?";
        $deleteStmt = $dataBase->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $idStorageUnit);
        $success = $deleteStmt->execute();

        // Eliminar la Storage Unit
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
