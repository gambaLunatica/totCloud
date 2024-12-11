
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
?>
<h1><?php echo $mode === 'edit' ? "Edit Database" : "Create Database"; ?></h1>
<div class="create-container">
    <form method="POST" action="classes/newDatabase.php"> <!-- Acción del formulario -->
        <h1>Choose a name for your Database</h1>
        <div class="form-group">
            <input type="text" id="db_name" name="db_name" placeholder="Database Name" required>
        </div>

        <h1>Description</h1>
            <div class="form-group">        
                <input type="text" id="description" name="description" placeholder="Database Description" required>
                <br><br>
            </div>

        <h1>Configuration Database</h1>
            <div class="form-group">
                <h2>MySQL</h2>
                <select name="nameMySQL" id="nameMySQL" onchange="togglePostgradeSelect()">
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
                <h2>Postgrade</h2>
                <select name="namePostgrade" id="namePostgrade" onchange="toggleMySQLSelect()">
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
            <div class="form-group">  
                <input type="hidden" name="mode" value="<?= $mode; ?>"> <!-- Valor de $mode -->
                <?php if ($mode === 'edit'): ?>
                    <input type="hidden" name="idDataBase" value="<?= $idDataBase; ?>"> <!-- ID de la base de datos -->
                    <button type="submit" class="btn btn-primary">Update Database</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-success">Create Database</button>
                <?php endif; ?>
            </div>
    </form>
</div>
<script>
function togglePostgradeSelect() {
    const mysqlSelect = document.getElementById("nameMySQL");
    const postgradeSelect = document.getElementById("namePostgrade");

    // Si se selecciona una opción en MySQL, deshabilitar Postgrade
    postgradeSelect.disabled = mysqlSelect.value !== "";
    if (mysqlSelect.value === "") {
        postgradeSelect.disabled = false; // Habilitar si está vacío
    }
}

function toggleMySQLSelect() {
    const mysqlSelect = document.getElementById("nameMySQL");
    const postgradeSelect = document.getElementById("namePostgrade");

    // Si se selecciona una opción en Postgrade, deshabilitar MySQL
    mysqlSelect.disabled = postgradeSelect.value !== "";
    if (postgradeSelect.value === "") {
        mysqlSelect.disabled = false; // Habilitar si está vacío
    }
}
</script>