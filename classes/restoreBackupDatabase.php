<?php
require 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        
        $idStorageUnit = intval($_POST['idStorageUnit']);
        $backupDate = $_POST['backupDate'];

    try {
        // Cargar backup
        $dataBase->loadBackUpSU($idStorageUnit, $backupDate);

        // Mensaje de éxito
        echo "Backup restored successfully!";
    } catch (Exception $e) {
        // Manejar errores
        echo $e->getMessage();
    }
}
?>