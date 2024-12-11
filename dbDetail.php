<!DOCTYPE html>
<html lang="en">
<script src="functions.js"></script>
<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

    $database = json_decode(urldecode($_GET['database']), true);
    $databasedata = $dataBase->getDb(htmlspecialchars($database['idDataBase']));

    //echo "<pre>";
    //print_r($databasedata);
    //echo "</pre>";
    if (!empty($databasedata)) {

        $databasedetails = $databasedata[0];
        $dbSettings = [];
        $dbSettings = $dataBase->getDBSetting($databasedetails['idDataBase']);
        
        if($databasedetails['idDBTypeMySQL'] != null)
        {
            $hold = $dataBase->getDBMySQL(htmlspecialchars($databasedetails['idDBTypeMySQL']));
            $dbmysql = $hold[0];
            $statusName = $dbmysql['statusName'];
            $releaseDate = $dbmysql['releaseDate'];
            $var = $dbmysql['version'];
        }
        else if ($databasedetails['idDBTypePostgrade'] != null)
        {
            $hold = $dataBase->getDBPostgrade(htmlspecialchars($databasedetails['idDBTypePostgrade']));
            $dbpostgrade = $hold[0];
            $statusName = $dbpostgrade['statusName'];
            $releaseDate = $dbpostgrade['releaseDate'];
            $var = $dbpostgrade['build'];
        }
    } else {
        $databasedetails = null;
    }
    //-------------------------------PARA LUNA--------------------------------------------------------
    // Te dejo aquí la clave primaria de la base de datos seleccionada
    $pkDB = $database['idDataBase'];
    echo "<pre>";
    print_r("Primary Key Data Base: $pkDB \n");
    echo "</pre>";
    //------------------------------------------------------------------------------------------------
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
            <?php if ($databasedetails['idDBTypeMySQL'] != null): ?>
                <p> MySQL Version: <?= htmlspecialchars($var); ?> </p>
            <?php elseif ($databasedetails['idDBTypePostgrade'] != null): ?>
                <p> PostgreSQL Build: <?= htmlspecialchars($var); ?> </p>
            <?php endif; ?>
            <p>Description : <?= htmlspecialchars($databasedetails['description']); ?></p>
            <p>Settings: </p>
            <?php foreach ($dbSettings as $ds): ?>
                <p>Setting name: <?= htmlspecialchars($ds['nameSetting']); ?> 
                    Value: 
                    <?php if ($ds['booleanValue'] !== null): ?>
                        <?= $ds['booleanValue'] ? 'True' : 'False'; ?>
                    <?php elseif ($ds['decimalValue'] !== null): ?>
                        <?= htmlspecialchars($ds['decimalValue']); ?>
                    <?php elseif ($ds['stringValue'] !== null): ?>
                        <?= htmlspecialchars($ds['stringValue']); ?>
                    <?php else: ?>
                        None
                    <?php endif; ?>
                </p>
            <?php endforeach; ?>
            <form id="editDB" action="formDB.php" method="GET">
                <input type="hidden" name="idDataBase" value="<?= htmlspecialchars($pkDB); ?>">
                <input type="hidden" name="mode" value="edit">
                <button type="submit" class="btn btn-primary">Edit Database</button>
            </form>
        </div>
    </div>
</body>