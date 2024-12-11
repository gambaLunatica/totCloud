<?php
include "dataBase.php";
include "user.php";

// Hacer las variables globales accesibles en todo el script
global $cpus, $memorys, $images, $subnets, $nameCompany, $idUserGroup;

// Inicializar variables globales para almacenamiento
$cpus = [];
$memorys = [];
$images = [];
$subnets = [];
$nameCompany = null;
$idUserGroup = null;

// Obtener el email del usuario autenticado
$user = unserialize($_SESSION["user"]);
$email = $user->getEmail();

// Paso 1: Obtener el grupo de usuarios y nombre de la compañía
$queryUserGroup = "
    SELECT UG.idUserGroup, UG.nameCompany
    FROM MYUSER AS MU
    INNER JOIN USERGROUP AS UG ON MU.idUserGroup = UG.idUserGroup
    WHERE MU.email = ?";
$stmtUserGroup = $dataBase->prepare($queryUserGroup);
$stmtUserGroup->bind_param("s", $email);
$stmtUserGroup->execute();
$stmtUserGroup->bind_result($idUserGroup, $nameCompany);
if ($stmtUserGroup->fetch()) {
    $_SESSION['nameCompany'] = $nameCompany;
}
$stmtUserGroup->close();

// Paso 2: Obtener CPUs disponibles
$queryCPUs = "
    SELECT c.model, c.coreCount, c.frequency, c.cost 
    FROM CPU c
    LEFT JOIN CompatibilityMemoryCPU cmc ON c.model = cmc.model
    LEFT JOIN CompatibilityCPUImage cci ON c.model = cci.model
    WHERE cmc.idMemory IS NOT NULL AND cci.idImage IS NOT NULL
";
$stmtCPUs = $dataBase->prepare($queryCPUs);
$stmtCPUs->execute();
$stmtCPUs->bind_result($model, $coreCount, $frequency, $cost);

while ($stmtCPUs->fetch()) {
    $cpus[] = ['model' => $model, 'coreCount' => $coreCount, 'frequency' => $frequency, 'cost' => $cost];
}
$_SESSION['cpus'] = $cpus;
$stmtCPUs->close();

// Paso 3: Obtener memorias disponibles
$queryMemorys = "
    SELECT m.totalCapacity, m.IOSpeed, m.generation, m.cost, m.idMemory
    FROM MEMORY m
    LEFT JOIN CompatibilityMemoryCPU cmc ON m.idMemory = cmc.idMemory
    LEFT JOIN CPU c ON cmc.model = c.model
    WHERE c.model IS NOT NULL
";
$stmtMemorys = $dataBase->prepare($queryMemorys);
$stmtMemorys->execute();
$stmtMemorys->bind_result($totalCapacity, $IOSpeed, $generation, $cost, $idMemory);

while ($stmtMemorys->fetch()) {
    $memorys[] = [
        'totalCapacity' => $totalCapacity,
        'IOSpeed' => $IOSpeed,
        'generation' => $generation,
        'cost' => $cost,
        'idMemory' => $idMemory
    ];
}
$_SESSION['memorys'] = $memorys;
$stmtMemorys->close();

// Paso 4: Obtener imágenes disponibles
$queryImage = "
    SELECT i.idImage, i.OSname, i.build, i.cost
    FROM IMAGE i
    LEFT JOIN CompatibilityCPUImage cci ON i.idImage = cci.idImage
    LEFT JOIN CPU c ON cci.model = c.model
    WHERE c.model IS NOT NULL
";
$stmtImage = $dataBase->prepare($queryImage);
$stmtImage->execute();
$stmtImage->bind_result($idImage, $OSname, $build, $cost);

while ($stmtImage->fetch()) {
    $images[] = ['idImage'=>$idImage, 'OSname' => $OSname, 'build' => $build, 'cost' => $cost];
}
$_SESSION['images'] = $images;
$stmtImage->close();

// Paso 5: Obtener subredes disponibles
$querySubnet = "SELECT idSubnet, nameSubnet, IP FROM SUBNET";
$stmtSubnet = $dataBase->prepare($querySubnet);
$stmtSubnet->execute();
$stmtSubnet->bind_result($idSubnet, $nameSubnet, $IP);

while ($stmtSubnet->fetch()) {
    $subnets[] = ['idSubnet' => $idSubnet, 'subnetName' => $nameSubnet, 'IP' => $IP];
}
$_SESSION['subnets'] = $subnets;
$stmtSubnet->close();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores enviados por el formulario
    $vmName = $_POST['vm_name'];
    $cpuModel = $_POST['cpu_model'];
    
    $memoryId = $_POST['memory_capacity'];
    $imageId = $_POST['image_name'];
    $subnetId = $_POST['subnet_name']; // Asegúrate de que el formulario incluya este campo
    $mode = $_POST['mode']; // Por defecto, es 'create'
    $idComputeInstance = $_POST['idComputeInstance'];
    // Verificar que todos los campos estén completos
    if (empty($vmName) || empty($cpuModel) || empty($memoryId) || empty($imageId) || empty($subnetId)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Insertar la nueva máquina virtual en la base de datos
    $creationDate = date("Y-m-d H:i:s"); // Fecha actual
    $sshKey = "exampleSSHKey"; // Cambia esto por una clave SSH real o por un input del usuario

    if($mode === 'edit') {
        // Actualizar la máquina virtual existente
        $queryUpdateVM = "
            UPDATE COMPUTEINSTANCE
            SET creationDate = ?, sshKey = ?, name = ?, idSubnet = ?, nameCompany = ?, idMemory = ?, model = ?, idImage = ?
            WHERE idComputeInstance = ?";
        $stmtUpdate = $dataBase->prepare($queryUpdateVM);
        $stmtUpdate->bind_param(
            "ssssssssi",
            $creationDate,
            $sshKey,
            $vmName,
            $subnetId,
            $nameCompany,
            $memoryId,
            $cpuModel,
            $imageId,
            $idComputeInstance
        );

        // Ejecutar el `UPDATE`
        if ($stmtUpdate->execute()) {
            echo "La máquina virtual se ha actualizado exitosamente.";
        } else {
            echo "Error al actualizar la máquina virtual: " . $stmtUpdate->error;
        }
        $stmtUpdate->close();
        exit;
    }else{
        // Crear una nueva máquina virtual
        $queryInsertVM = "
            INSERT INTO COMPUTEINSTANCE (creationDate, sshKey, name, idSubnet, nameCompany, idMemory, model, idImage)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = $dataBase->prepare($queryInsertVM);
        $stmtInsert->bind_param(
            "ssssssss",
            $creationDate,
            $sshKey,
            $vmName,
            $subnetId,
            $nameCompany,
            $memoryId,
            $cpuModel,
            $imageId
        );

        // Ejecutar el `INSERT`
        if ($stmtInsert->execute()) {
            echo "La máquina virtual se ha creado exitosamente.";
        } else {
            echo "Error al crear la máquina virtual: " . $stmtInsert->error;
        }
        $stmtInsert->close();
    }
}

?>
