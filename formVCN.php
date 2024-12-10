<?php
// Incluir archivo con la clase de base de datos
require "classes/dataBase.php";
include "head.php";


// Procesar el formulario si se envió
$message = ""; // Variable para mostrar mensajes de éxito o error
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $dataBase->processForm(); // Método para procesar el formulario
        $message = "New database created successfully!";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
// Obtener opciones para los desplegables
$companies = $dataBase->getCompanies(); // Método para obtener las compañías
$subnets = $dataBase->getSubnets();     // Método para obtener las subredes
$computeInstances = $dataBase->getComputeInstances(); // Método para obtener instancias
$mysqlVersions = $dataBase->getMySQLVersions(); // Método para obtener versiones de MySQL
$postgreVersions = $dataBase->getPostgreVersions(); // Método para obtener versiones de PostgreSQL
?>

<h1>Create New Database</h1>
    <?php if ($message): ?>
        <p class="message <?= strpos($message, 'Error') !== false ? 'error' : '' ?>"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="dataBase.php">
        <label for="nameCompany">Company:</label>
        <select id="nameCompany" name="nameCompany" required>
            <option value="" selected>Select a company</option>
            <?php foreach ($companies as $company): ?>
                <option value="<?= htmlspecialchars($company['nameCompany']) ?>">
                    <?= htmlspecialchars($company['nameCompany']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="idSubnet">Subnet:</label>
        <select id="idSubnet" name="idSubnet" required>
            <option value="" selected>Select a subnet</option>
            <?php foreach ($subnets as $subnet): ?>
                <option value="<?= htmlspecialchars($subnet['idSubnet']) ?>">
                    <?= htmlspecialchars($subnet['subnetName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="idComputeInstance">Compute Instance:</label>
        <select id="idComputeInstance" name="idComputeInstance" required>
            <option value="" selected>Select a compute instance</option>
            <?php foreach ($computeInstances as $instance): ?>
                <option value="<?= htmlspecialchars($instance['idComputeInstance']) ?>">
                    <?= htmlspecialchars($instance['instanceName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="idDBTypeMySQL">MySQL Version:</label>
        <select id="idDBTypeMySQL" name="idDBTypeMySQL">
            <option value="" selected>Select a MySQL version</option>
            <?php foreach ($mysqlVersions as $mysql): ?>
                <option value="<?= htmlspecialchars($mysql['idDBType']) ?>">
                    <?= htmlspecialchars($mysql['version']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="idDBTypePostgrade">PostgreSQL Version:</label>
        <select id="idDBTypePostgrade" name="idDBTypePostgrade">
            <option value="" selected>Select a PostgreSQL version</option>
            <?php foreach ($postgreVersions as $postgre): ?>
                <option value="<?= htmlspecialchars($postgre['idDBType']) ?>">
                    <?= htmlspecialchars($postgre['build']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="nameDataBase">Database Name:</label>
        <input type="text" id="nameDataBase" name="nameDataBase" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <button type="submit">Create Database</button>
    </form>