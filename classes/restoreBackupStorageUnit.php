<?php
require 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        
        $backupID = intval($_POST['backupID']);
        $backupDate = $_POST['backupDate'];

    try {
        // Cargar backup
        $dataBase->loadBackUpSU($backupID, $backupDate);

        // Mensaje de éxito
        echo "Backup restored successfully!";
    } catch (Exception $e) {
        // Manejar errores
        echo $e->getMessage();
    }
}
?>