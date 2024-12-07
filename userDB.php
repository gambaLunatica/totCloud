<?php
if(!$dataBase->canViewDataBases()){
    header("Location: guestDB.php");
    exit();
}

$databases = [];
$databases = $dataBase->getUserDatabases();
?>
<div class="container-services">
    <h1>Data Bases</h1>
    <?php if ($databases): ?>
        <div class="card-container">
            <?php foreach ($databases as $database): ?>
                <div class="card">
                    <div class="card-icon">
                        <img src="iconos/base-de-datos.png" alt="Database">
                    </div>
                    <h2><?= htmlspecialchars($database['nameDataBase']); ?></h2>
                    <p>Description: <?= htmlspecialchars($database['description']); ?></p>
                    <p>Creation Date: <?= htmlspecialchars($database['creationDate']); ?></p>
                </div>
            <?php endforeach; ?>
            <!-- Tarjeta para agregar nuevo -->
            <div class="card new">
                <div class="icon">
                    <img src="iconos/anadir.png" alt="Add">
                </div>
                <h2>NEW</h2>
            </div>
        </div>
    <?php else: ?>
        <p>No databases services found for this user.</p>
    <?php endif; ?>