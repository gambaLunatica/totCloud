<!DOCTYPE html>
<html lang="en">

<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

    $storage = json_decode(urldecode($_GET['storage']), true);
    $storagedata = $dataBase->getStorageData(htmlspecialchars($storage['nameStorage']));
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
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($storageDetails['nameStorage']); ?></h1>
    <div class="container">
        <div class="feature">
            <p style="font-size: 16px; display: flex; align-items: center;"> 
                <span style="width: 12px; height: 12px; border-radius: 50%; 
                    margin-right: 8px; 
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
            <div style="width: 100%; background-color: #e0e0e0; border-radius: 8px; overflow: hidden; margin-top: 20px;">
                <div style="width: <?= htmlspecialchars($usagePercentage); ?>%; background-color: <?= ($usagePercentage > 80) ? 'red' : 'blue'; ?>; height: 20px; text-align: center; color: white; font-size: 14px; font-weight: bold;">
                    <?= htmlspecialchars(number_format($usagePercentage, 0)); ?>%
                </div>
            </div>
        </div>
        <button type="submit"class="btn btn-success">Edit</button>
    </div>
</body>