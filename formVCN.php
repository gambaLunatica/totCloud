<script src="functions.js"></script>
<?php
include 'head.php';
include 'classes/newVCN.php';
include 'navbar.php';
?>

<div class="create-container">
    <form method="POST" action="classes/newVCN.php"> <!-- Acción del formulario -->
        <div class="form-group>
                <label for="vcn_name">Nombre de la red virtual:</label>
            <input type="text" id="vcn_name" name="vcn_name" placeholder="Escribe un nombre para tu VCN" required>
        </div>
        <h1>Choose a Region for your Virtual Cloud Network</h1>
            <div class="form-group>            
                <label for="nameRegion">Select a Region:</label>
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
                <br><br>
            </div>
        
        <h1>Choose a Mask for your Virtual Cloud Network</h1>
            <div class="form-group>        
                <label for="cidr">Select a Mask:</label>
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
                <br><br>
            </div>
        <h1>Choose a IP for your Virtual Cloud Network</h1>
        <div class="form-group">
            <label for="IP">IP:</label>
            <input type="text" id="IP" name="IP" placeholder="Escribe una IP para tu VCN" 
                maxlength="4" required 
                oninput="validateBinaryInput(this)">
            <small id="ipError" style="color: red; display: none;">Solo se permiten 1 y 0.</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Crear VCN</button>
    </form>
</div>