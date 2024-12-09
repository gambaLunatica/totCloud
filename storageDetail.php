<!DOCTYPE html>
<html lang="en">
<script src="functions.js"></script>
<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

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
    $pkS = $storageDetails['nameStorage'];;
    //------------------------------------------------------------------------------------------------
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
            <p>
                <span style="color: blue;">
                    <?= htmlspecialchars(number_format($usedSpace, 0)); ?>
                </span>
                /
                <span style="color: gray;">
                    <?= htmlspecialchars(number_format($totalCapacity, 0)); ?>
                </span> GB
            </p>
            <p>
                <?= htmlspecialchars(number_format($remainingSpace, 0)); ?> GB REMAINING
            </p>
        </div>
            <div class="detail-feature" style="width: 100%; background-color: #e0e0e0; border-radius: 8px; overflow: hidden; margin-top: 20px;">
                <div style="width: <?= htmlspecialchars($usagePercentage); ?>%; background-color: <?= ($usagePercentage > 80) ? 'red' : 'blue'; ?>; height: 20px; text-align: center; color: white; font-size: 14px; font-weight: bold;">
                    <?= htmlspecialchars(number_format($usagePercentage, 0)); ?>%
                </div>
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
        window.close();
    })
    .catch(error => {
        console.error('Error:', error);
        alert();
    });
}
</script>