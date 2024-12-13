<!DOCTYPE html>
<html lang="en">
<script src="functions.js"></script>
<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";
    include 'navbar.php';

    $storage = json_decode(urldecode($_GET['storage']), true);
    $storagedata = $dataBase ->getStorage(htmlspecialchars($storage['nameStorage']));
    //$usCI = $dataBase->getUserComputeInstances();

    //echo "<pre>";
    //print_r($storagedata);
    //echo "</pre>";
    if (!empty($storagedata)) {
        $storageDetails = $storagedata[0];
        $usedSpace = $storage['usedSpace'] ?? 0;
        $totalCapacity = $storageDetails['totalCapacity'] ?? 0;
        $remainingSpace = $totalCapacity - $usedSpace;
        $statusName = $storageDetails['statusName'] ?? 'Unknown';
        $usagePercentage = ($totalCapacity > 0) ? ($usedSpace / $totalCapacity) * 100 : 0;
    } else {
        $storageDetails = null;
    }

    //-------------------------------PARA LUNA--------------------------------------------------------
    // Te dejo aquí la clave primaria de Storage Unit y la clave primaria del Storage seleccionado
    $pkSU = $storage['idStorageUnit'];
    $pkS = $storageDetails['nameStorage'];
    //------------------------------------------------------------------------------------------------
    $backups = [];
    $backups = $dataBase->getBackUpInfoStorageUnit($pkSU);

    $queryUsage = "SELECT value, creationDate FROM MyUsage WHERE idStorageUnit = ? ORDER BY creationDate";
    $stmt = $dataBase->prepare($queryUsage);
    $stmt->bind_param("i", $storage['idStorageUnit']);
    $stmt->execute();
    $result = $stmt->get_result();
    $usageData = [];
    while ($row = $result->fetch_assoc()) {
        $usageData[] = [
            "x" => strtotime($row['creationDate']) * 1000, 
            "y" => (float)$row['value']
        ];
    }
    $stmt->close();
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($storage['nameStorageU']); ?></h1>
    <div class="detail-container">
        <div class="detail-feature">
            <p> 
                <span style="
                    background-color: <?= ($statusName === 'Live') ? 'green' : 'red'; ?>;">
                </span>

                Status: <?= htmlspecialchars($statusName); ?>
            </p>
        </div>
            <!-- Barra de Uso -->
        <div class="usage-bar">
            <div class="usage-bar-fill" style="
                width: <?= htmlspecialchars($usagePercentage); ?>%; 
                background-color: <?= ($usagePercentage > 80) ? 'red' : 'blue'; ?>;">
                <?= htmlspecialchars(number_format($usagePercentage, 0)); ?>%
            </div>
        </div>
        <div class="detail-feature">
            <p>
                <span style="color: blue;">
                    <?= htmlspecialchars(number_format($usedSpace, 0)); ?>
                </span>
                /
                <span style="color: gray;">
                    <?= htmlspecialchars(number_format($totalCapacity, 0)); ?>
                </span> 
            </p>
            <p>GB</p>
            <p>
                <?= htmlspecialchars(number_format($remainingSpace, 0)); ?> GB REMAINING
            </p>
        </div>
        <div class="detail-feature">
            <form id="deleteStorageForm" action="classes/deleteStorage.php" method="post" onsubmit="return confirm('Are you sure you want to delete this Storage?');">
                <input type="hidden" name="idStorageUnit" value="<?= htmlspecialchars($storage['idStorageUnit']); ?>">
                <button type="submit" class="btn btn-danger" onclick="deleteAndClose(event)">Delete Storage Unit</button>
            </form>

            <form id="editStorageU" action="formStorageU.php" method="GET">
                <input type="hidden" name="idStorageU" value="<?= htmlspecialchars($pkSU); ?>">
                <input type="hidden" name="mode" value="edit">
                <button type="submit" class="btn btn-primary">Edit Unit</button>
            </form>
        </div>
        <div class="detail-feature">
            <form id="restoreBackupForm" method="POST" action="classes/restoreBackupStorageUnit.php" onsubmit="return confirm('Are you sure you want to load this backup?');">
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
        <div id="storageUsageChart" style="width:100%; height:400px;"></div>
    </div>
</body>

<script>
function deleteAndClose(event) {
    event.preventDefault();
    const form = document.getElementById('deleteStorageForm');
    const formData = new FormData(form);

    fetch('classes/deleteStorage.php', {
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
        window.location.href = "Storagepage.php";
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

    fetch('classes/restoreBackupStorageUnit.php', {
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
document.addEventListener('DOMContentLoaded', function () {
    const usageData = <?php echo json_encode($usageData); ?>;

    Highcharts.chart('storageUsageChart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Storage Usage Over Time'
        },
        xAxis: {
            type: 'datetime',
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: 'Value'
            }
        },
        series: [{
            name: 'Usage',
            data: usageData
        }]
    });
});
</script>
