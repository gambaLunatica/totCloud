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

        $queryTables = "SELECT nameTable FROM MyTable WHERE idDataBase = ?";
        $stmtTables = $dataBase->prepare($queryTables);
        $stmtTables->bind_param("i", $databasedetails['idDataBase']);
        $stmtTables->execute();
        $resultTables = $stmtTables->get_result();
        $tables = $resultTables->fetch_all(MYSQLI_ASSOC);
        $stmtTables->close();
    } else {
        $databasedetails = null;
        $tables = [];
    }
    //-------------------------------PARA LUNA--------------------------------------------------------
    // Te dejo aquí la clave primaria de la base de datos seleccionada
    $pkDB = $database['idDataBase'];
    //------------------------------------------------------------------------------------------------
    $backups = [];
    $backups = $dataBase->getBackUpInfoDataBase($pkDB);
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
        </div>
        <div class="detail-feature">
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
            <p>Tables in Database:</p>
            <?php if (!empty($tables)): ?>
                <ul>
                    <?php foreach ($tables as $table): ?>
                        <li><?= htmlspecialchars($table['nameTable']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No tables found in this database.</p>
            <?php endif; ?>
            <form id="editTable" action="formTable.php" method="GET">
                <input type="hidden" name="idDataBase" value="<?= htmlspecialchars($pkDB); ?>">
                <button type="submit" class="btn btn-primary">Edit Tables</button>
            </form>
        </div>
        <div class="detail-feature">
            <form id="editDB" action="formDB.php" method="GET">
                <input type="hidden" name="idDataBase" value="<?= htmlspecialchars($pkDB); ?>">
                <input type="hidden" name="mode" value="edit">
                <button type="submit" class="btn btn-primary">Edit Database</button>
            </form>
            <form id="deleteDBForm" action="classes/deleteDatabase.php" method="post" onsubmit="return confirm('Are you sure you want to delete this Database?');">
                <input type="hidden" name="idDataBase" value="<?= htmlspecialchars($pkDB); ?>">
                <button type="submit" class="btn btn-danger" onclick="deleteAndClose(event)">Delete Database</button>
            </form>
        </div>
        <div class="detail-feature">
            <form id="restoreBackupForm" method="POST" action="classes/restoreBackupDatabase.php" onsubmit="return confirm('Are you sure you want to load this Database?');">
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
        window.location.href = "DBpage.php";
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

    fetch('classes/restoreBackupDatabase.php', {
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