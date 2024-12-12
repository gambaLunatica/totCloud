<?php
include 'head.php';
include 'classes/newDatabase.php';
include 'navbar.php';

global $idDataBase;
$idDataBase = null;
$databasedetails = $dataBase->getDB($idDataBase);
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $idDataBase = $_GET['idDataBase'] ?? null;
}
$queryTables = "SELECT idTable, nameTable FROM MyTable WHERE idDataBase = ?";
        $stmtTables = $dataBase->prepare($queryTables);
        $stmtTables->bind_param("i", $idDataBase);
        $stmtTables->execute();
        $resultTables = $stmtTables->get_result();
        $tables = $resultTables->fetch_all(MYSQLI_ASSOC);
        $stmtTables->close();
?>
<!--<h1 style="text-align: center;"><?= htmlspecialchars($databasedetails['nameDataBase']); ?></h1>-->
    <div class="detail-container">
    <h1>Tables in Database</h1>
        <?php if (!empty($tables)): ?>
            <?php foreach ($tables as $table): ?>
                <form id="editTableForm" action="classes/newTable.php" method="GET">
                        <div class="detail-feature">
                            <span><?= htmlspecialchars($table['nameTable']); ?></span>
                            <input type="text" id="updateName" name="updateName" placeholder="New Table Name">
                            <input type="hidden" name="idTable" value="<?= htmlspecialchars($table['idTable']); ?>">
                            <input type="hidden" name="idDataBase" value="<?= htmlspecialchars($idDataBase); ?>">
                            <!-- Botón de editar -->
                            <button type="submit" name="mode" value="edit">Edit Table</button>
                            <!-- Botón de eliminar -->
                            <button type="submit" name="mode" value="delete">Delete Table</button>
                        </div>
                </form>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tables found in this database.</p>
        <?php endif; ?> 
        <!-- Formulario para agregar una nueva tabla -->
        <form id="createTableForm" action="classes/newTable.php" method="GET">
                <h3>Create New Table</h3>
                <div class="form-group">
                    <label for="newTableName">Table Name:</label>
                    <input type="hidden" name="idDataBase" value="<?= htmlspecialchars($idDataBase); ?>">
                    <input type="text" id="newTableName" name="newTableName" required class="form-control">
                    <input type="hidden" name="mode" value="create">
                    <button type="submit" class="btn btn-primary">Add Table</button>
                </div>
                
        </form>
    </div>