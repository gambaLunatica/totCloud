<?php
if(!$dataBase->canViewDataBases()){
    header("Location: guestDB.php");
    exit();
}

$databases = [];
$databases = $dataBase->getUserDatabases();
?>
<h1>Databases</h1>
    <?php if ($databases): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>idDataBase</th>
                    <th>nameCompany</th>
                    <th>idSubnet</th>
                    <th>idComputeInstance</th>
                    <th>idDBTypeMySQL</th>
                    <th>idDBTypePostgrade</th>
                    <th>creationDate</th>
                    <th>nameDataBase</th>
                    <th>description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($databases as $db): ?>
                    <tr>
                        <td><?= htmlspecialchars($db['idDataBase']); ?></td>
                        <td><?= htmlspecialchars($db['nameCompany']); ?></td>
                        <td><?= htmlspecialchars($db['idSubnet']); ?></td>
                        <td><?= htmlspecialchars($db['idComputeInstance']); ?></td>
                        <td><?= htmlspecialchars($db['idDBTypeMySQL']); ?></td>
                        <td><?= htmlspecialchars($db['idDBTypePostgrade']); ?></td>
                        <td><?= htmlspecialchars($db['creationDate']); ?></td>
                        <td><?= htmlspecialchars($db['nameDataBase']); ?></td>
                        <td><?= htmlspecialchars($db['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No databases found for this user.</p>
    <?php endif; ?>