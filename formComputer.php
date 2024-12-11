<?php
include 'head.php';
include 'classes/newComputer.php';
include 'navbar.php';

global $mode;  // Declaramos la variable $mode
global $idComputeInstance; // Declaramos la variable $idComputeInstance

// Establecemos valores por defecto
$mode = 'create';  // Valor por defecto
$idComputeInstance = null;     // Inicializamos $idComputeInstance como null

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Establecemos el valor de $mode desde el formulario, si está presente
    $mode = $_GET['mode'] ?? 'create';  // Si no existe, 'create' será el valor por defecto
    $idComputeInstance = $_GET['idComputeInstance'] ?? null;    // ID del Compute Instance a editar, si está presente
}

// Para depuración, mostrar los valores obtenidos
echo $mode;
echo $idComputeInstance;
?>

<h1><?php echo $mode === 'edit' ? "Edit Compute Instance" : "Create Compute Instance"; ?></h1>
<div class="create-container">
    <form method="POST" action="classes/newComputer.php"> <!-- Acción del formulario -->
        <div class="form-group">
                <label for="vm_name">Nombre de la máquina virtual:</label>
            <input type="text" id="vm_name" name="vm_name" placeholder="Escribe un nombre para tu VM" required>
        </div>
        <h1>Choose a CPU for yout Virtual Machine</h1>
            <div class="form-group">            
                <label for="cpu_model">Select a CPU:</label>
                <select name="cpu_model" id="cpu_model" required>
                    <option value="">Select a CPU</option>
                    <?php
                    if (isset($_SESSION['cpus']) && !empty($_SESSION['cpus'])) {
                        foreach ($_SESSION['cpus'] as $cpu) {
                            echo "<option value='" . htmlspecialchars($cpu['model']) . "'>" . 
                                htmlspecialchars($cpu['model']) . " - " .
                                htmlspecialchars($cpu['coreCount']) . " Núcleos, " .
                                htmlspecialchars($cpu['frequency']) . " GHz, $" . 
                                 htmlspecialchars($cpu['cost']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable CPU .</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>

        <h1>Choose a Memory for your Virtual Machine</h1>
 
            <div class="form-group">        
                <label for="memory_capacity">Select a Memory:</label>
                <select name="memory_capacity" id="memory_capacity" required>
                    <option value="">Select a Memory</option>
                    <?php
                    if (isset($_SESSION['memorys']) && !empty($_SESSION['memorys'])) {
                        foreach ($_SESSION['memorys'] as $memory) {
                            echo "<option value='" . htmlspecialchars($memory['idMemory']) . "'>" . 
                                htmlspecialchars($memory['totalCapacity']) . " GB, " .
                                htmlspecialchars($memory['IOSpeed']) . " MHz, " .
                                htmlspecialchars($memory['generation']) . " Generation, $" . 
                                htmlspecialchars($memory['cost']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable Memory .</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>

        <h1>Choose a Image for your Virtual Machine</h1>         
            <div class="form-group">        
                <label for="image_name">Select a Image:</label>
                <select name="image_name" id="image_name" required>
                    <option value="">Select a Image</option>
                    <?php
                    if (isset($_SESSION['images']) && !empty($_SESSION['images'])) {
                        foreach ($_SESSION['images'] as $image) {
                            echo "<option value='" . htmlspecialchars($image['idImage']) . "'>" . 
                                htmlspecialchars($image['OSname']) . " - " .
                                htmlspecialchars($image['build']) . " Build, $" . 
                                htmlspecialchars($image['cost']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable Image .</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>

        <h1>Choose a Subnet for your Virtual Machine</h1>
         
            <div class="form-group">        
                <label for="subnet_name">Select a Subnet:</label>
                <select name="subnet_name" id="subnet_name" required>
                    <option value="">Select a Subnet</option>
                    <?php
                    if (isset($_SESSION['subnets']) && !empty($_SESSION['subnets'])) {
                        foreach ($_SESSION['subnets'] as $subnet) {
                            echo "<option value='" . htmlspecialchars($subnet['idSubnet']) . "'>" . 
                                htmlspecialchars($subnet['subnetName']) . " - " .
                                htmlspecialchars($subnet['subnetCIDR']) . " CIDR, " .
                                htmlspecialchars($subnet['subnetGateway']) . " Gateway</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable Subnet .</option>";
                    }
                    ?>
                </select>
                <br><br>
            </div>
            <input type="hidden" name="mode" value="<?= $mode; ?>"> <!-- Campo oculto para enviar el modo -->
            <?php if ($mode === 'edit'): ?>
                <input type="hidden" name="idComputeInstance" value="<?= $idComputeInstance; ?>"> <!-- Campo oculto para enviar el ID -->
                <button type="submit" class="btn btn-primary">Update Compute Instance</button>
            <?php else: ?>
                <button type="submit" class="btn btn-success">Create Compute Instance</button>
            <?php endif; ?>
    </form>
</div>

