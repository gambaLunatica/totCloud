<?php
if(!$dataBase->canViewStorageUnits()){
    header("Location: guestStorage.php");
    exit();
}

$storageServices = [];
$storageServices = $dataBase->getUserStorageUnits();
?>
<div class="container-services">
    <h1>Storage Units</h1>
    <?php if ($storageServices): ?>
        <div class="card-container">
            <?php foreach ($storageServices as $storage): ?>
                <div class="card">
                    <div class="card-icon">
                        <img src="iconos/nube.png" alt="Storage Unit">
                    </div>
                    <h2><?= htmlspecialchars($storage['nameStorageU']); ?></h2>
                    <p>Name Storage: <?= htmlspecialchars($storage['nameStorage']); ?></p>
                    <p>Used Space: <?= htmlspecialchars($storage['usedSpace']); ?></p>
                    <p>Creation Date: <?= htmlspecialchars($storage['creationDate']); ?></p>
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
        <p>No storage services found for this user.</p>
    <?php endif; ?>