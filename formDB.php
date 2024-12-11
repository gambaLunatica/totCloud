<script src="functions.js"></script>
<?php
include 'head.php';
include 'classes/newDatabase.php';
include 'navbar.php';

global $mode;  // Declaramos la variable $mode
global $idDataBase; // Declaramos la variable $idDataBase

// Establecemos valores por defecto
$mode = 'create';  // Valor por defecto
$idDataBase = null;     // Inicializamos $idDataBase como null

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Establecemos el valor de $mode desde el formulario, si está presente
    $mode = $_GET['mode'] ?? 'create';  // Si no existe, 'create' será el valor por defecto
    $idDataBase = $_GET['idDataBase'] ?? null;    // ID de la base de datos a editar, si está presente
}

// Para depuración, mostrar los valores obtenidos
echo $mode;
echo $idDataBase;
?>

<div class="create-container">
    <form method="POST" action="classes/newDatabase.php"> <!-- Acción del formulario -->
        <div class="form-group">
                <label for="db_name">Database name:</label>
            <input type="text" id="db_name" name="db_name" placeholder="Escribe un nombre para tu base de datos" required>
        </div>

        <h1>Description</h1>
            <div class="form-group">        
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" placeholder="Escribe una descripción para tu base de datos" required>
                <br><br>
            </div>

        <h1>Configuration Database</h1>
            <div class="form-group">
                <label for="nameMySQL">Select MySQL Version:</label>
                <select name="nameMySQL" id="nameMySQL">
                    <option value="">None</option> <!-- Retornará NULL al backend -->
                    <?php
                    foreach ($_SESSION['idDBType'] as $mysql) {
                        echo "<option value='" . htmlspecialchars($mysql['idDBType']) . "'>" . 
                        htmlspecialchars($mysql['version']). 
                        htmlspecialchars($mysql['cost']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="namePostgrade">Select PostgreSQL Version:</label>
                <select name="namePostgrade" id="namePostgrade">
                    <option value="">None</option> <!-- Retornará NULL al backend -->
                    <?php
                    foreach ($_SESSION['idDBType'] as $postgrade) {
                        echo "<option value='" . htmlspecialchars($postgrade['idDBType']) . "'>" . 
                        htmlspecialchars($postgrade['build']). 
                        htmlspecialchars($postgrade['cost']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        <h1>Choose a Subnet for your Database</h1>
            <div class="form-group">            
                <label for="nameSubnet">Select a Subnet:</label>
                <select name="nameSubnet" id="nameSubnet" required>
                    <option value="">Select a Subnet</option>
                    <?php
                    foreach ($_SESSION['Subnet'] as $subnet) {
                        echo "<option value='" . htmlspecialchars($subnet['idSubnet']) . "'>" . 
                        htmlspecialchars($subnet['nameSubnet']) . " - " .
                        htmlspecialchars($subnet['cidr']) . " - " .
                        htmlspecialchars($subnet['IP']) . "</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>

        <h1>Choose a Compute Instance for your Database</h1>
            <div class="form-group">        
                <label for="nameComputeInstance">Select a Compute Instance:</label>
                <select name="nameComputeInstance" id="nameComputeInstance" required>
                    <option value="">Select a Compute Instance</option>
                    <?php
                    foreach ($_SESSION['ComputeInstance'] as $ComputeInstance) {
                        echo "<option value='" . htmlspecialchars($ComputeInstance['idComputeInstance']) . "'>" . 
                        htmlspecialchars($ComputeInstance['name']) . "</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>
            <input type="hidden" name="mode" value="<?= $mode; ?>"> <!-- Valor de $mode -->
            <?php if ($mode === 'edit'): ?>
                <input type="hidden" name="idDataBase" value="<?= $idDataBase; ?>"> <!-- ID de la base de datos -->
                <button type="submit" class="btn btn-primary">Update Database</button>
            <?php else: ?>
                <button type="submit" class="btn btn-success">Create Database</button>
            <?php endif; ?>
    </form>
</div>

