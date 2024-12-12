<?php
require 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        if (!isset($_POST['idDataBase']) || !is_numeric($_POST['idDataBase'])) {
            throw new Exception("Invalid or missing database ID.");
        }

        $idDatabase = intval($_POST['idDataBase']);

        // Preparamos la llamada al procedimiento almacenado
        $deleteDb = $dataBase->prepare("CALL deleteDatabase(?)");
        if (!$deleteDb) {
            throw new Exception("Failed to prepare the statement: " . $dataBase->error);
        }

        $deleteDb->bind_param("i", $idDatabase);

        // Ejecutamos la consulta
        if (!$deleteDb->execute()) {
            throw new Exception("Error executing the procedure: " . $deleteDb->error);
        }

        echo "Database deleted successfully.";

        // Cerramos el statement
        $deleteDb->close();

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}

?>