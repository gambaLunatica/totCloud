<?php
require 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idVCN = htmlspecialchars($_POST['idVCN']);
    
    try {

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
?>
