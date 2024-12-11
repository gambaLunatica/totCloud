<?php
require 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idVCN = htmlspecialchars($_POST['idComputeInstance']);
    
    try {
        // Verificar si la Computer Instance tiene Data Bases asociadas
        $query = "SELECT COUNT(*) as count FROM MyDataBase WHERE idComputeInstance = ?";
        $stmt = $dataBase->prepare($query);
        $stmt->bind_param("i", $idVCN);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            echo "Computer Instance has associated Data Bases and cannot be deleted.";
            exit();
        }

        // Verificar si la Computer Instance tiene Storage Units asociadas
        $query = "SELECT COUNT(*) as count FROM StorageUnit WHERE idComputeInstance = ?";
        $stmt = $dataBase->prepare($query);
        $stmt->bind_param("i", $idVCN);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            echo "Computer Instance has associated Storage Units and cannot be deleted.";
            exit();
        }

        // Eliminar la CI
        $deleteQuery = "DELETE FROM ComputeInstance WHERE idComputeInstance = ?";
        $deleteStmt = $dataBase->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $idVCN);
        $success = $deleteStmt->execute();

        if ($success) {
            echo "Computer Instance deleted successfully.";
        } else {
            throw new Exception("Error deleting Computer Instance: ");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
