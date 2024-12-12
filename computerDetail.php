<script src="functions.js"></script>
<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

    $computer = json_decode(urldecode($_GET['computer']), true);
    $computerdata = $dataBase->getComputeInstance(htmlspecialchars($computer['idComputeInstance']));
    //echo "<pre>";
    //print_r($computerdata);
    //echo "</pre>";
    if (!empty($computerdata)) {
        $computerDetails = $computerdata[0];
        $hold = $dataBase->getCPUComputeInstance(htmlspecialchars($computerDetails['model']));
        $cpu = $hold[0];
        $statusName = $cpu['statusName'];
        $model = $cpu['model'];
        $series = $cpu['series'];
    } else {
        $storageDetails = null;
    }
    //-------------------------------PARA LUNA--------------------------------------------------------
    // Te dejo aquí la clave primaria de la compute instance seleccionada
    $pkCI = $computer['idComputeInstance'];
    //------------------------------------------------------------------------------------------------
    $backups = [];
    $backups = $dataBase->getBackUpInfoComputeInstance($pkCI);
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($computerDetails['name']); ?></h1>
    <div class="detail-container">
        <div class="detail-feature">
            <p> 
                <span style=" 
                    background-color: <?= ($statusName === 'Live') ? 'green' : 'red'; ?>;">
                </span>

                CPU Status: <?= htmlspecialchars($statusName); ?>
            </p>
            <p> CPU model: <?=htmlspecialchars($model); ?> </p>
            <p> CPU sries: <?=htmlspecialchars($series); ?> </p>
            <p> Download ssh key: <?=htmlspecialchars($computerDetails['sshKey']); ?> </p>
        </div>
        <div class="detail-feature">
            <form id="editComputer" action="formComputer.php" method="GET">
                <input type="hidden" name="idComputeInstance" value="<?= htmlspecialchars($pkCI); ?>">
                <input type="hidden" name="mode" value="edit">
                <button type="submit" class="btn btn-primary">Edit Virtual Machine</button>
            </form>
            <form id="deleteCIForm" action="classes/deleteComputer.php" method="post" onsubmit="return confirm('Are you sure you want to delete this Computer Instance?');">
                <input type="hidden" name="idComputeInstance" value="<?= htmlspecialchars($computer['idComputeInstance']); ?>">
                <button type="submit" class="btn btn-danger" onclick="deleteAndClose(event)">Delete Virtual Machine</button>
            </form>
        </div>
        <div class="detail-feature">
            <form id="restoreBackupForm" method="POST" action="classes/restoreBackupComputeInstance.php" onsubmit="return confirm('Are you sure you want to load this Compute Instance?');">
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
    const form = document.getElementById('deleteCIForm');
    const formData = new FormData(form);

    fetch('classes/deleteComputer.php', {
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

    fetch('classes/restoreBackupComputeInstance.php', {
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