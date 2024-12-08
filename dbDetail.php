<!DOCTYPE html>
<html lang="en">

<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

    $database = json_decode(urldecode($_GET['database']), true);
    $databasedata = $dataBase->getDbData(htmlspecialchars($database['idDataBase']));
    //echo "<pre>";
    //print_r($databasedata);
    //echo "</pre>";
    if (!empty($databasedata)) {
        $databasedetails = $databasedata[0];
        $statusName = $databasedetails['mysqlStatus'] ?? $databasedetails['postgreStatus'];
        $releaseDate = $databasedetails['mysqlReleaseDate'] ?? $databasedetails['postgreReleaseDate'];
        $cost = $databasedetails['mysqlCost'] ?? $databasedetails['postgreCost'];
    } else {
        $databasedetails = null;
    }
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($databasedetails['nameDataBase']); ?></h1>
    <div class="container">
        <div class="feature">
            <p style="font-size: 16px; display: flex; align-items: center;"> 
                <span style="width: 12px; height: 12px; border-radius: 50%; 
                    margin-right: 8px; 
                    background-color: <?= ($statusName === 'Live') ? 'green' : 'red'; ?>;">
                </span>

                Status: <?= htmlspecialchars($statusName); ?>
            </p>
            <p> Release Date: <?= htmlspecialchars($releaseDate);?> </p>
            <p> Total Cost: <?= htmlspecialchars($cost);?> </p>
            <?php if ($databasedetails['idDBTypeMySQL'] != null): ?>
                <p> MySQL Version: <?= htmlspecialchars($databasedetails['mysqlVersion']); ?> </p>
            <?php elseif ($databasedetails['idDBTypePostgrade'] != null): ?>
                <p> PostgreSQL Build: <?= htmlspecialchars($databasedetails['postgreBuild']); ?> </p>
            <?php endif; ?>

        </div>
    </div>
</body>