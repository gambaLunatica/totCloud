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
    //------------------------------------------------------------------------------------------------
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($databasedetails['nameDataBase']); ?></h1>
    <div class="detail-container">
        <div class="detail-feature">
            <p> 
                <span style="
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
        </div>
        <div class="detail-feature">
            <form id="editDB" action="formDB.php" method="GET">
                <input type="hidden" name="idDataBase" value="<?= htmlspecialchars($pkDB); ?>">
                <input type="hidden" name="mode" value="edit">
                <button type="submit" class="btn btn-primary">Edit Database</button>
            </form>
        </div>
        <form id="deleteDBForm" action="classes/deleteDatabase.php" method="post" onsubmit="return confirm('Are you sure you want to delete this Database?');">
                <input type="hidden" name="idDataBase" value="<?= htmlspecialchars($pkDB); ?>">
                <button type="submit" class="btn btn-danger" onclick="deleteAndClose(event)">Delete Database</button>
        </form>
    </div>
</body>

<script>
function deleteAndClose(event) {
    event.preventDefault();
    const form = document.getElementById('deleteDBForm');
    const formData = new FormData(form);

    fetch('classes/deleteDatabase.php', {
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