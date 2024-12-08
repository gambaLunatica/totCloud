<!DOCTYPE html>
<html lang="en">

<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

    $computer = json_decode(urldecode($_GET['computer']), true);
    $computerdata = $dataBase->getComputeData(htmlspecialchars($computer['idComputeInstance']));
    echo "<pre>";
    print_r($computerdata);
    echo "</pre>";
    if (!empty($computerdata)) {
        $computerDetails = $computerdata[0];
        $statusName = $computerDetails['statusName'] ?? 'Unknown';
    } else {
        $storageDetails = null;
    }
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($computerDetails['name']); ?></h1>
    <div class="container">
        <div class="feature">
            <p style="font-size: 16px; display: flex; align-items: center;"> 
                <span style="width: 12px; height: 12px; border-radius: 50%; 
                    margin-right: 8px; 
                    background-color: <?= ($statusName === 'Live') ? 'green' : 'red'; ?>;">
                </span>

                CPU Status: <?= htmlspecialchars($statusName); ?>
            </p>
            <p> CPU model: <?=htmlspecialchars($computerDetails['model']); ?> </p>
            <p> CPU sries: <?=htmlspecialchars($computerDetails['cpuSeries']); ?> </p>
            <p> Download ssh key: <?=htmlspecialchars($computerDetails['sshKey']); ?> </p>
        </div>
    </div>
</body>