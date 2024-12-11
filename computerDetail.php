<script src="functions.js"></script>
<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

    $computer = json_decode(urldecode($_GET['computer']), true);
    $computerdata = $dataBase->getComputeInstance(htmlspecialchars($computer['idComputeInstance']));
    //echo "<pre>";
    //print_r($computerdata);
    //echo "</pre>";
    if (!empty($computerdata)) {
        $computerDetails = $computerdata[0];
        $hold = $dataBase->getCPUComputeInstance(htmlspecialchars($computerDetails['model']));
        $cpu = $hold[0];
        $statusName = $cpu['statusName'];
        $model = $cpu['model'];
        $series = $cpu['series'];
    } else {
        $storageDetails = null;
    }
    //-------------------------------PARA LUNA--------------------------------------------------------
    // Te dejo aquí la clave primaria de la compute instance seleccionada
    $pkCI = $computer['idComputeInstance'];
    echo "<pre>";
    print_r("Primary Key Compute Instance: $pkCI \n");
    echo "</pre>";
    //------------------------------------------------------------------------------------------------
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($computerDetails['name']); ?></h1>
    <div class="container">
        <div class="feature">
        <p style="font-size: 16px; display: flex; align-items: center;"> 
                <span style="width: 12px; height: 12px; border-radius: 50%; 
                    margin-right: 8px; 
                    background-color: <?= ($statusName === 'Live') ? 'green' : 'red'; ?>;">
                </span>

                CPU Status: <?= htmlspecialchars($statusName); ?>
            </p>
            <p> CPU model: <?=htmlspecialchars($model); ?> </p>
            <p> CPU sries: <?=htmlspecialchars($series); ?> </p>
            <p> Download ssh key: <?=htmlspecialchars($computerDetails['sshKey']); ?> </p>
            <button onclick="navigateTo('editStorageU.php')">Edit</button>
            <form id="editComputer" action="formComputer.php" method="GET">
                <input type="hidden" name="idComputeInstance" value="<?= htmlspecialchars($pkCI); ?>">
                <input type="hidden" name="mode" value="edit">
                <button type="submit" class="btn btn-primary">Edit VCN</button>
            </form>
        </div>
    </div>
</body>

<script>
function deleteAndClose(event) {
    event.preventDefault();
    const form = document.getElementById('deleteCIForm');
    const formData = new FormData(form);

    fetch('classes/deleteComputer.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.text();
    })
    .then(data => {
        alert(data);
        window.close();
    })
    .catch(error => {
        console.error('Error:', error);
        alert();
    });
}
</script>