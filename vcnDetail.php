<!DOCTYPE html>
<html lang="en">
<script src="functions.js"></script>
<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

    $vcn = json_decode(urldecode($_GET['vcn']), true);
    $vcndata = $dataBase->getVCN(htmlspecialchars($vcn['idVCN']));

    //echo "<pre>";
    //print_r($vcndata);
    //echo "</pre>";
    if (!empty($vcndata)) {

        $vcndetails = $vcndata[0];

        $subnetlist = [];
        $subnetlist = $dataBase->getSubnetVCN($vcndetails['idVCN']);

        $name = $vcndetails['nameVCN'];
        $ip = $vcndetails['privateIP'];
        $cidr = $vcndetails['cidr'];
        $region = $vcndetails['nameRegion'];
        
    } else {
        $vcndetails = null;
    }
    //-------------------------------PARA LUNA--------------------------------------------------------
    // Te dejo aquí la clave primaria de la vcn seleccionada
    $pkVCN = $vcn['idVCN'];
    //------------------------------------------------------------------------------------------------
    $backups = [];
    $backups = $dataBase->getBackUpInfoVCN($pkVCN);
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($name); ?></h1>
    <div class="detail-container">
        <div class="detail-feature">
            <p>IP : <?= htmlspecialchars($ip);?> </p>
            <p>Cidr : <?= htmlspecialchars($cidr); ?></p>
            <p>Region: <?= htmlspecialchars($region); ?></p>
            <!-- Añado lsitado de subnets por rellenar, no se si haría falta-->
        </div>
        <div class="detail-feature">
            <p>List of Subnets :</p>
                <ul style="padding-left: 20px;"> <!-- Lista con tabulación -->
                    <?php foreach ($subnetlist as $s): ?>
                        <li>
                            Subnet Name: <?= htmlspecialchars($s['nameSubnet']); ?><br>
                            Subnet IP: <?= htmlspecialchars($s['IP']); ?><br>
                            Subnet Cidr: <?= htmlspecialchars($s['cidr']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
        </div>
        <div class="detail-feature">
            <!-- Botón para editar -->
            <form id="editVCNForm" action="formVCN.php" method="GET">
                <input type="hidden" name="idVCN" value="<?= htmlspecialchars($pkVCN); ?>">
                <input type="hidden" name="mode" value="edit">
                <button type="submit" class="btn btn-primary">Edit VCN</button>
            </form>
            <form id="deleteVCNForm" action="classes/deleteVCN.php" method="post" onsubmit="return confirm('Are you sure you want to delete this VCN?');">
                <input type="hidden" name="idVCN" value="<?= htmlspecialchars($vcndetails['idVCN']); ?>">
                <button type="submit" class="btn btn-danger" onclick="deleteAndClose(event)">Delete VCN</button>
            </form>
        </div>
        <div class="detail-feature">
            <form id="restoreBackupForm" method="POST" action="classes/restoreBackupVCN.php" onsubmit="return confirm('Are you sure you want to load this vcn?');">
                <label for="backupDate">Select a backup:</label>
                <select name="backupDate" id="backupDate" required>
                    <?php foreach ($backups as $backup): ?>
                        <option value="<?= htmlspecialchars($backup['backupDate']); ?>">
                            <?= htmlspecialchars($backup['backupDate']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="backupID" value="<?= htmlspecialchars($backup['backupID']); ?>">
                <button type="submit" class="btn btn-primary" onclick="deleteAndClose2(event)">Restore Backup</button>
            </form>
        </div>
    </div>
</body>

<script>
function deleteAndClose(event) {
    event.preventDefault();
    const form = document.getElementById('deleteVCNForm');
    const formData = new FormData(form);

    fetch('classes/deleteVCN.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.text();
    })
    .then(data => {
        alert(data);
        window.close();
    })
    .catch(error => {
        console.error('Error:', error);
        alert();
    });
}
function deleteAndClose2(event) {
    event.preventDefault();
    const form = document.getElementById('restoreBackupForm');
    const formData = new FormData(form);

    fetch('classes/restoreBackupVCN.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.text();
    })
    .then(data => {
        alert(data);
        window.close();
    })
    .catch(error => {
        console.error('Error:', error);
        alert();
    });
}
</script>