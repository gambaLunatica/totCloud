<?php
include "dataBase.php";
include "user.php";

// Hacer las variables globales accesibles en todo el script
global $nameCompany, $idUserGroup, $nameRegion, $cidr;

// Inicializar variables globales para almacenamiento
$nameCompany = null;
$idUserGroup = null;
$nameRegion = null;
$cidr = null;

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

// Paso 2: Obtener regiones disponibles
$queryRegions = "SELECT nameRegion FROM REGION";
$stmtRegions = $dataBase->prepare($queryRegions);
$stmtRegions->execute();
$stmtRegions->bind_result($nameRegion);

while ($stmtRegions->fetch()) {
    $regions[] = ['nameRegion' => $nameRegion];
}
$_SESSION['regions'] = $regions;
$stmtRegions->close();

// Paso 3: Obtener Mask disponibles
$queryMask = "SELECT cidr, cost FROM Mask";
$stmtMask = $dataBase->prepare($queryMask);
$stmtMask->execute();
$stmtMask->bind_result($cidr, $cost);

while ($stmtMask->fetch()) {
    $masks[] = ['cidr' => $cidr, 'cost' => $cost];
}
$_SESSION['masks'] = $masks;
$stmtMask->close();

//verificar si se ha enviado el formulario
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cidr = $_POST['cidr'];
    $nameRegion = $_POST['nameRegion'];
    $privateIP = $_POST['IP'];
    $nameVCN = $_POST['vcn_name'];

    //verificar si los campos no estan vacios
    if(empty($cidr) || empty($nameRegion) || empty($privateIP) || empty($nameVCN)){
        echo "Please fill all the fields";
        exit;
    }
    // Verificar si tiene exactamente 4 caracteres y solo contiene 1 y 0
    if (strlen($privateIP) === 4 && preg_match('/^[01]+$/', $privateIP)) {
        // Procesar la IP (por ejemplo, guardarla en la base de datos)
    } else {
        echo "Error: La IP debe tener 4 caracteres y solo contener 1 y 0.";
    }

    $creationDate = date("Y-m-d H:i:s"); // Fecha actual
    $queryVCN = "INSERT INTO VCN (cidr, nameCompany, nameRegion, privateIP, creationDate, nameVCN) VALUES (?, ?, ?, ?, ?, ?)";

    $stmtVCN = $dataBase->prepare($queryVCN);
    $stmtVCN->bind_param("ssssss", $cidr, $nameCompany, $nameRegion, $privateIP, $creationDate, $nameVCN);

    if($stmtVCN->execute()){
        echo "VCN created successfully";
    }else{
        echo "Error creating VCN";
    }
    $stmtVCN->close();
}
?>