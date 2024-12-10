<?php
include "classes/userGroup.php";
include "classes/memory.php";
include "classes/image.php";
if (!$dataBase->canViewComputeInstances()) {
    header("Location: guestComputer.php");
    exit();
}

$computerServices = [];
$computerServices = $dataBase->getUserComputeInstances();
?>
<div class="container-services">
    <h1>Compute Instances</h1>
    <?php if ($computerServices): ?>
        <div class="card-container">
            <?php foreach ($computerServices as $computer): 
                $memory = $dataBase->selectMemory($computer['idMemory']);
                $image = $dataBase->selectImage($computer['idImage']);
                ?>
                <div class="card" onclick="openComputerInstanceDetail('<?= urlencode(json_encode($computer)) ?>')"
                    style="width:220px; margin:10px; height:300px; background-color:#36393e; border-radius:6px;">
                    <div class="icon-circle-mid">
                        <i class="fa-solid fa-computer"></i>
                    </div>
                    <h2><?= htmlspecialchars($computer['name']); ?></h2>
                    <p>CPU: <?= htmlspecialchars($computer['model']); ?></p>
                    <p>Memory: <?= $memory->getTotalCapacity(); ?> GB</p>
                    <p><?= $image->getOsName() ?></p>
                    <p><?= (new DateTime($computer['creationDate']))->format('Y-m-d') ?></p>
                </div>
            <?php endforeach; ?>
            <!-- Tarjeta para agregar nuevo -->
            <div class="card new" onclick="openNewComputerInstance()">
                <div class="icon">
                    <img src="iconos/anadir.png" alt="Add">
                </div>
                <h2>NEW</h2>
            </div>
        </div>
    <?php else: ?>
        <p>No se encontraron servicios de Compute Instances para este usuario.</p>
    <?php endif; ?>
</div>

<script>
    // Función para abrir detalles de una unidad de almacenamiento
    function openComputerInstanceDetail(computerData) {
        const url = `computerDetail.php?computer=${encodeURIComponent(computerData)}`;
        window.open(url, '_blank', 'width=800,height=600');
    }

    // Función para abrir formulario de nueva unidad de almacenamiento
    function openNewComputerInstance() {
        const url = 'formComputer.php';
        window.open(url, '_blank', 'width=800,height=600');
    }
</script>