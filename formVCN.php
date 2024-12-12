<script src="functions.js"></script>
<?php
include 'head.php';
include 'classes/newVCN.php';
include 'navbar.php';

global $mode;  // Declaramos la variable $mode
global $idVCN; // Declaramos la variable $idVCN

// Establecemos valores por defecto
$mode = 'create';  // Valor por defecto
$idVCN = null;     // Inicializamos $idVCN como null

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Establecemos el valor de $mode desde el formulario, si está presente
    $mode = $_GET['mode'] ?? 'create';  // Si no existe, 'create' será el valor por defecto
    $idVCN = $_GET['idVCN'] ?? null;    // ID del VCN a editar, si está presente
}

?>

<h1><?php echo $mode === 'edit' ? "Edit VCN" : "Create VCN"; ?></h1>
<div class="create-container">
    <form method="POST" action="classes/newVCN.php"> <!-- Acción del formulario -->
        <h1>Choose a name for your Virtual Cloud Network</h1>
        <div class="form-group">
            <input type="text" id="vcn_name" name="vcn_name" placeholder="VCN name" required>
        </div>
        <h1>Choose a Region for your Virtual Cloud Network</h1>
        <div class="form-group">            
                <select name="nameRegion" id="nameRegion" required>
                    <option value="">Select a Region</option>
                    <?php
                    if (isset($_SESSION['regions']) && !empty($_SESSION['regions'])) {
                        foreach ($_SESSION['regions'] as $region) {
                            echo "<option value='" . htmlspecialchars($region['nameRegion']) . "'>" . 
                                htmlspecialchars($region['nameRegion']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable Region .</option>";
                    }
                    ?>
                </select>
            </div>
        
        
        <h1>Choose a Mask for your Virtual Cloud Network</h1>
        <div class="form-group">        
                <select name="cidr" id="cidr" required>
                    <option value="">Select a Mask</option>
                    <?php
                    if (isset($_SESSION['masks']) && !empty($_SESSION['masks'])) {
                        foreach ($_SESSION['masks'] as $mask) {
                            echo "<option value='" . htmlspecialchars($mask['cidr']) . "'>" . 
                                htmlspecialchars($mask['cost']) . " - $" .
                                htmlspecialchars($mask['cidr']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>There not avilable Mask .</option>";
                    }
                    ?>
                </select>
            </div>
        <h1>Choose a IP for your Virtual Cloud Network</h1>
        <div class="form-group">
            <input type="text" id="IP" name="IP" placeholder="Escribe una IP para tu VCN" 
                maxlength="4" required 
                oninput="validateBinaryInput(this)">
            <small id="ipError" style="color: red; display: none;">Solo se permiten 1 y 0.</small>
        </div>
        <br><br>
        <div class="form-group">
            <input type="hidden" name="mode" value="<?php echo htmlspecialchars($mode); ?>">
            <?php if ($mode === 'edit'): ?>
                <input type="hidden" name="idVCN" value="<?php echo htmlspecialchars($idVCN); ?>">
                <button type="submit" class="btn btn-primary">Update VCN</button>
            <?php else: ?>
                <button type="submit" class="btn btn-success">Create VCN</button>
            <?php endif; ?>
        </div>
    </form>
</div>