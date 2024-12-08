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
                <div class="card" onclick="openDBDetail('<?= urlencode(json_encode($database)) ?>')">
                    <div class="card-icon">
                        <img src="iconos/base-de-datos.png" alt="Database">
                    </div>
                    <h2><?= htmlspecialchars($database['nameDataBase']); ?></h2>
                    <p>Description: <?= htmlspecialchars($database['description']); ?></p>
                    <p>Creation Date: <?= htmlspecialchars($database['creationDate']); ?></p>
                </div>
            <?php endforeach; ?>
            <!-- Tarjeta para agregar nuevo -->
            <div class="card new" onclick="openNewDBForm()">
                <div class="icon">
                    <img src="iconos/anadir.png" alt="Add">
                </div>
                <h2>NEW</h2>
            </div>
        </div>
    <?php else: ?>
        <p>No databases services found for this user.</p>
    <?php endif; ?>
</div>
<script>
    // Función para abrir detalles de una base de datos
    function openDBDetail(dbData) {
        const url = `dbDetail.php?database=${encodeURIComponent(dbData)}`;
        window.open(url, '_blank', 'width=800,height=600');
    }

    // Función para abrir formulario de nueva base de datos
    function openNewDBForm() {
        const url = 'index.php';
        window.open(url, '_blank', 'width=800,height=600');
    }
</script>