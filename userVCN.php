<?php
//$db = new MyDataBase($con);
if(!$dataBase->canViewVCNs()){
    header("Location: guestVCN.php");
    exit();
}

$vcnServices = [];
$vcnServices = $dataBase->getUserVCN();
?>
<h1>Virtual Cloud Networks (VCN)</h1>
    <?php if ($vcnServices): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Private IP</th>
                    <th>Creation Date</th>
                    <th>CIDR</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vcnServices as $vcn): ?>
                    <tr>
                        <td><?= htmlspecialchars($vcn['idVCN']); ?></td>
                        <td><?= htmlspecialchars($vcn['nameVCN']); ?></td>
                        <td><?= htmlspecialchars($vcn['privateIP']); ?></td>
                        <td><?= htmlspecialchars($vcn['creationDate']); ?></td>
                        <td><?= htmlspecialchars($vcn['cidr']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No VCN services found for this user.</p>
    <?php endif; ?>
    