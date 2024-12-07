<?php
if(!$dataBase->canViewStorageUnits()){
    header("Location: guestStorage.php");
    exit();
}

$storageServices = [];
$storageServices = $dataBase->getUserStorageUnits();
?>
<h1>User Storage</h1>
    <?php if ($storageServices): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>idStorageUnit</th>
                    <th>nameCompany</th>
                    <th>idSubnet</th>
                    <th>idComputeInstance</th>
                    <th>usedSpace</th>
                    <th>creationDate</th>
                    <th>nameStorageU</th>
                    <th>idUserGroup</th>
                    <th>nameStorage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($storageServices as $storage): ?>
                    <tr>
                        <td><?= htmlspecialchars($storage['idStorageUnit']); ?></td>
                        <td><?= htmlspecialchars($storage['nameCompany']); ?></td>
                        <td><?= htmlspecialchars($storage['idSubnet']); ?></td>
                        <td><?= htmlspecialchars($storage['idComputeInstance']); ?></td>
                        <td><?= htmlspecialchars($storage['usedSpace']); ?></td>
                        <td><?= htmlspecialchars($storage['creationDate']); ?></td>
                        <td><?= htmlspecialchars($storage['nameStorageU']); ?></td>
                        <td><?= htmlspecialchars($storage['idUserGroup']); ?></td>
                        <td><?= htmlspecialchars($storage['nameStorage']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No storage services found for this user.</p>
    <?php endif; ?>