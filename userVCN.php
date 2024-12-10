<script src="functions.js"></script>
<?php
//$db = new MyDataBase($con);
if(!$dataBase->canViewVCNs()){
    header("Location: guestVCN.php");
    exit();
}

$vcnServices = [];
$vcnServices = $dataBase->getUserVCN();
?>
<div class="container-services">
    <h1>Virtual Cloud Networks</h1>
    <?php if ($vcnServices): ?>
        <div class="card-container">
            <?php foreach ($vcnServices as $vcn): ?>
                <div class="card">
                    <div class="card-icon">
                        <img src="iconos/internet.png" alt="VCN">
                    </div>
                    <h2><?= htmlspecialchars($vcn['nameVCN']); ?></h2>
                    <p>IP: <?= htmlspecialchars($vcn['privateIP']); ?></p>
                    <p>CIDR: <?= htmlspecialchars($vcn['cidr']); ?></p>
                    <p>Region: <?= htmlspecialchars($vcn['nameRegion']); ?></p>
                    <p>Creation Date: <?= htmlspecialchars($vcn['creationDate']); ?></p>
                </div>
            <?php endforeach; ?>
            <!-- Tarjeta para agregar nuevo -->
            <div class="card new" onclick="navigateTo('formVCN.php')">
                <div class="icon">
                    <img src="iconos/anadir.png" alt="Add">
                </div>
                <h2>NEW</h2>
            </div>
        </div>
    <?php else: ?>
        <p>No VCN services found for this user.</p>
    <?php endif; ?>