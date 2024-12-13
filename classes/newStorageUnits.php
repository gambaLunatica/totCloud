<?php
include "dataBase.php";
include "user.php";

// Hacer las variables globales accesibles en todo el script
global $nameCompany, $idUserGroup, $Subnet, $ComputeInstanece, $storage;

// Inicializar variables globales para almacenamiento
$nameCompany = null;
$idUserGroup = null;
$Subnet = [];
$ComputeInstanece = [];
$storage = [];

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

// Paso 2: Obtener Subnet disponibles
$querySubnet = "SELECT idSubnet, nameSubnet, cidr, IP FROM Subnet";
$stmtSubnet = $dataBase->prepare($querySubnet);
$stmtSubnet->execute();
$stmtSubnet->bind_result($idSubnet, $nameSubnet, $cidr, $IP);

while ($stmtSubnet->fetch()) {
    $Subnet[] = ['idSubnet' => $idSubnet, 'nameSubnet' => $nameSubnet, 'cidr' => $cidr, 'IP' => $IP];
}
$_SESSION['Subnet'] = $Subnet;
$stmtSubnet->close();

// Paso 3: Obtener ComputeInstanece disponibles
$queryComputeInstance = "SELECT idComputeInstance, name FROM ComputeInstance";
$stmtComputeInstance = $dataBase->prepare($queryComputeInstance);
$stmtComputeInstance->execute();
$stmtComputeInstance->bind_result($idComputeInstance, $name);

while ($stmtComputeInstance->fetch()) {
    $ComputeInstance[] = ['idComputeInstance' => $idComputeInstance, 'name' => $name];
}
$_SESSION['ComputeInstance'] = $ComputeInstance;
$stmtComputeInstance->close();


// Paso 4: Obtener Storage disponibles
$queryStorage = "SELECT nameStorage, totalCapacity, IOSpeed, typeName, cost FROM Storage";
$stmtStorage = $dataBase->prepare($queryStorage);
$stmtStorage->execute();

$stmtStorage->bind_result($nameStorage, $totalCapacity, $IOSpeed, $typeName, $cost);

while ($stmtStorage->fetch()) {
    $storage[] = ['nameStorage' => $nameStorage, 'totalCapacity' => $totalCapacity, 'IOSpeed' => $IOSpeed, 'typeName' => $typeName, 'cost' => $cost];
}
$_SESSION['storage'] = $storage;
$stmtStorage->close();

$action = $_POST['action'] ?? ''; // Valor del botón presionado
//verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nameSubnet = $_POST['nameSubnet'];
    $nameComputeInstanece = $_POST['nameComputeInstance'];
    $nameStorage = $_POST['nameStorage'];
    $nameStorageU = $_POST['storage_nameU'];
    $mode = $_POST['mode']; // Por defecto, es 'create'
    

    if($mode === 'edit'){
        $idStorageU = $_POST['idStorageUnit'];
        // Actualizar el almacenamiento en la base de datos
        $query = "
            UPDATE StorageUnit
            SET idSubnet = ?, idComputeInstance = ?, nameStorage = ?, nameStorageU = ?
            WHERE idStorageUnit = ?";
        $stmt = $dataBase->prepare($query);
        $stmt->bind_param("sssss", $nameSubnet, $nameComputeInstanece, $nameStorage, $nameStorageU, $idStorageU);
        if($stmt->execute()){
            echo "<script>
                alert('Storage Unit updated successfully.');
                window.close();
            </script>";
        } else {
            echo "Error updating Storage Unit.";
        }
        $stmt->close();
    } else {
        if(empty($nameSubnet) || empty($nameComputeInstanece) || empty($nameStorage) || empty($nameStorageU)){
            echo "Please fill all the fields";
            exit;
        }
        // Insertar el almacenamiento en la base de datos
        $usedSpace = 0;
        $queryStorage = "INSERT INTO StorageUnit (nameCompany, idSubnet, idComputeInstance, usedSpace, nameStorageU, idUserGroup, nameStorage) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        $stmtStorage = $dataBase->prepare($queryStorage);
        $stmtStorage->bind_param("sssssss", $nameCompany, $nameSubnet, $nameComputeInstanece, $usedSpace, $nameStorageU, $idUserGroup, $nameStorage);
        if($stmtStorage->execute()){
            echo "<script>
                alert('Storage Unit created successfully.');
                window.close();
            </script>";
            $storageUnitID = $stmtStorage->insert_id;
            $queryUsageFunction = "CALL InsertStorageUnitUsage(?, 100)";
            $stmtUsageFunction = $dataBase->prepare($queryUsageFunction);
            $stmtUsageFunction->bind_param("i", $storageUnitID);
            $stmtUsageFunction->execute();
            exit;
        } else {
            echo "Error creating Storage Unit.";
        }
        $stmtStorage->close();
    }

}

