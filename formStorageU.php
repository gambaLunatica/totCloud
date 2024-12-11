<?php
include 'head.php';
include 'classes/newStorageUnits.php';
include 'navbar.php';

global $mode;  // Declaramos la variable $mode
global $idStorageUnit; // Declaramos la variable $idStorageUnit

// Establecemos valores por defecto
$mode = 'create';  // Valor por defecto
$idStorageUnit = null;     // Inicializamos $idStorageUnit como null

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Establecemos el valor de $mode desde el formulario, si está presente
    $mode = $_GET['mode'] ?? 'create';  // Si no existe, 'create' será el valor por defecto
    $idStorageUnit = $_GET['idStorageU'] ?? null;    // ID del Storage Unit a editar, si está presente
}
?>

<h1><?php echo $mode === 'edit' ? "Edit Storage Unit" : "Create Storage Unit"; ?></h1>
<div class="create-container">
    <form method="POST" action="classes/newStorageUnits.php"> <!-- Acción del formulario -->
        <h1>Choose a name for your Storage Unit</h1>
        <div class="form-group">
            <input type="text" id="storage_nameU" name="storage_nameU" placeholder="Storage Unit name:" required>
        </div>
        <h1>Choose a Subnet for your Storage Unit</h1>
            <div class="form-group">            
                <select name="nameSubnet" id="nameSubnet" required>
                    <option value="">Select a Subnet</option>
                    <?php
                    if (isset($_SESSION['Subnet']) && !empty($_SESSION['Subnet'])) {
                        foreach ($_SESSION['Subnet'] as $subnet) {
                            echo "<option value='" . htmlspecialchars($subnet['idSubnet']) . "'>" . 
                                htmlspecialchars($subnet['nameSubnet']) . " - " .
                                htmlspecialchars($subnet['cidr']) . " - " .
                                htmlspecialchars($subnet['IP']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable Subnet .</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>

        <h1>Choose a Compute Instance for your Storage Unit</h1>
            <div class="form-group">        
                <select name="nameComputeInstance" id="nameComputeInstance" required>
                    <option value="">Select a Compute Instance</option>
                    <?php
                    if (isset($_SESSION['ComputeInstance']) && !empty($_SESSION['ComputeInstance'])) {
                        foreach ($_SESSION['ComputeInstance'] as $ComputeInstance) {
                            echo "<option value='" . htmlspecialchars($ComputeInstance['idComputeInstance']) . "'>" . 
                                htmlspecialchars($ComputeInstance['name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable Compute Instance .</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>

        <h1>Choose a Storage for your Storage Unit</h1>
            <div class="form-group">        
                <select name="nameStorage" id="nameStorage" required>
                    <option value="">Select a Storage</option>
                    <?php
                    if (isset($_SESSION['storage']) && !empty($_SESSION['storage'])) {
                        foreach ($_SESSION['storage'] as $storage) {
                            echo "<option value='" . htmlspecialchars($storage['nameStorage']) . "'>" . 
                                htmlspecialchars($storage['nameStorage']) . " - " .
                                htmlspecialchars($storage['totalCapacity']) . " GB, " .
                                htmlspecialchars($storage['IOSpeed']) . " MHz, " .
                                htmlspecialchars($storage['typeName']) . " - $" .
                                htmlspecialchars($storage['cost']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable Storage .</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>
            <div class="form-group">
                <input type="hidden" name="mode" value="<?php echo htmlspecialchars($mode); ?>">
                <?php if ($mode === 'edit'): ?>
                    <input type="hidden" name="idStorageUnit" value="<?php echo htmlspecialchars($idStorageUnit); ?>">
                    <button type="submit">Update Storage Unit</button>
                <?php else: ?>
                    <button type="submit">Create Storage Unit</button>
                <?php endif; ?>
            </div>
    </form>
</div>
