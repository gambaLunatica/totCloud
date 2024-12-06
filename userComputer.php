<?php
if(!$dataBase->canViewComputeInstances()){
    header("Location: guestComputer.php");
    exit();
}

$coputerServices = [];
$coputerServices = $dataBase->getUserComputeInstances();
?>
<h1>Computers Instances</h1>
    <?php if ($coputerServices): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>idSubnet</th>
                    <th>nameCompany</th>
                    <th>idMemory</th>
                    <th>idImage</th>
                    <th>model</th>
                    <th>name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coputerServices as $computer): ?>
                    <tr>
                        <td><?= htmlspecialchars($computer['idSubnet']); ?></td>
                        <td><?= htmlspecialchars($computer['nameCompany']); ?></td>
                        <td><?= htmlspecialchars($computer['idMemory']); ?></td>
                        <td><?= htmlspecialchars($computer['idImage']); ?></td>
                        <td><?= htmlspecialchars($computer['model']); ?></td>
                        <td><?= htmlspecialchars($computer['name']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No Computer services found for this user.</p>
    <?php endif; ?>
