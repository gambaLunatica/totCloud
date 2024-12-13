<?php
include "dataBase.php";
include "user.php";

global $nameCompany, $idUserGroup, $Subnet, $ComputeInstanece, $mySQl, $postgrade;
$nameCompany = null;
$idUserGroup = null;
$Subnet = [];
$ComputeInstanece = [];
$mySQl = [];
$postgrade = [];

$user = unserialize($_SESSION["user"]);
$email = $user->getEmail();


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

$querySubnet = "SELECT idSubnet, nameSubnet, cidr, IP FROM Subnet";
$stmtSubnet = $dataBase->prepare($querySubnet);
$stmtSubnet->execute();
$stmtSubnet->bind_result($idSubnet, $nameSubnet, $cidr, $IP);

while ($stmtSubnet->fetch()) {
    $Subnet[] = ['idSubnet' => $idSubnet, 'nameSubnet' => $nameSubnet, 'cidr' => $cidr, 'IP' => $IP];
}
$_SESSION['Subnet'] = $Subnet;
$stmtSubnet->close();

$queryComputeInstance = "SELECT idComputeInstance, name FROM ComputeInstance";
$stmtComputeInstance = $dataBase->prepare($queryComputeInstance);
$stmtComputeInstance->execute();
$stmtComputeInstance->bind_result($idComputeInstance, $name);

while ($stmtComputeInstance->fetch()) {
    $ComputeInstance[] = ['idComputeInstance' => $idComputeInstance, 'name' => $name];
}
$_SESSION['ComputeInstance'] = $ComputeInstance;
$stmtComputeInstance->close();

$queryMySQL = "SELECT idDBType,version, cost FROM DBTypeMySql";
$stmtMySQL = $dataBase->prepare($queryMySQL);
$stmtMySQL->execute();
$stmtMySQL->bind_result($idMySQL,$version, $cost);

while ($stmtMySQL->fetch()) {
    $mySQl[] = ['idDBType' => $idMySQL,'version' => $version, 'cost' => $cost];
}
$_SESSION['idDBType'] = $mySQl;
$stmtMySQL->close();

$queryPostgrade = "SELECT idDBType,build, cost FROM DBTypePostgrade";
$stmtPostgrade = $dataBase->prepare($queryPostgrade);
$stmtPostgrade->execute();
$stmtPostgrade->bind_result($idPostgrade, $version, $cost);

while ($stmtPostgrade->fetch()) {
    $postgrade[] = ['idDBType' => $idPostgrade, 'build' => $version, 'cost' => $cost];
}
$_SESSION['idDBType'] = $postgrade;
$stmtPostgrade->close();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nameSubnet = $_POST['nameSubnet'];
    $nameComputeInstance = $_POST['nameComputeInstance'];
    $mySQl = empty($_POST['nameMySQL']) ? null : $_POST['nameMySQL'];
    $postgrade = empty($_POST['namePostgrade']) ? null : $_POST['namePostgrade'];
    $nameDatabase = $_POST['db_name'];
    $description = $_POST['description'];
    $mode = $_POST['mode'];
    

    //Verificar que lso campos estén llenos
    

    $creationDate = date("Y-m-d H:i:s");

    if($mode === 'edit'){
        $idDataBase = $_POST['idDataBase'];
        $queryUpdate = "UPDATE MyDataBase SET creationDate = ?, idSubnet = ?, idComputeInstance = ?, idDBTypeMySQL = ?, idDBTypePostgrade = ?, nameDataBase = ?, description = ? WHERE idDataBase = ?";
        $stmt = $dataBase->prepare($queryUpdate);
        $stmt->bind_param("sssssssi", $creationDate, $nameSubnet, $nameComputeInstance, $mySQl, $postgrade, $nameDatabase, $description, $idDataBase);

        if($stmt->execute()){
            hewader("Location: ../userDB.php");
        }else{
            echo "Error updating database";
        }
    }else{
        if(empty($nameSubnet) || empty($nameComputeInstance) || empty($nameDatabase) || empty($description)||(empty($mySQl) && empty($postgrade))){
            echo "Please fill all the fields";
            exit;
        }
        $query = "CALL createDatabase(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dataBase->prepare($query);
        $stmt->bind_param("sssssss", $nameCompany, $nameSubnet, $nameComputeInstance, $mySQl, $postgrade, $nameDatabase, $description);

        if($stmt->execute()){
            header("Location: ../userDB.php");
            $databaseID = $stmtVCN->insert_id;
            $queryUsageFunction = "CALL InsertDatabaseUsage(?, 5000)";
            $stmtUsageFunction = $dataBase->prepare($queryUsageFunction);
            $stmtUsageFunction->bind_param("i", $databaseID);
            $stmtUsageFunction->execute();
            $stmtUsageFunction->close();
        }else{
            echo "Error creating database";
        }
    }

}
