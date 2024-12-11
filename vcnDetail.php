<!DOCTYPE html>
<html lang="en">

<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";

    $vcn = json_decode(urldecode($_GET['vcn']), true);
    $vcndata = $dataBase->getVCN(htmlspecialchars($vcn['idVCN']));

    //echo "<pre>";
    //print_r($vcndata);
    //echo "</pre>";
    if (!empty($vcndata)) {

        $vcndetails = $vcndata[0];

        $subnetlist = [];
        $subnetlist = $dataBase->getSubnetVCN($vcndetails['idVCN']);

        $name = $vcndetails['nameVCN'];
        $ip = $vcndetails['privateIP'];
        $cidr = $vcndetails['cidr'];
        $region = $vcndetails['nameRegion'];
        
    } else {
        $vcndetails = null;
    }
    //-------------------------------PARA LUNA--------------------------------------------------------
    // Te dejo aquí la clave primaria de la vcn seleccionada
    $pkVCN = $vcn['idVCN'];
    echo "<pre>";
    print_r("Primary Key VCN: $pkVCN \n");
    echo "</pre>";
    //------------------------------------------------------------------------------------------------
?>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($name); ?></h1>
    <div class="container">
        <div class="feature">
            <p>IP : <?= htmlspecialchars($ip);?> </p>
            <p>Cidr : <?= htmlspecialchars($cidr); ?></p>
            <p>Region: <?= htmlspecialchars($region); ?></p>
            <!-- Añado lsitado de subnets por rellenar, no se si haría falta-->
            <p>List of Subnets :</p>
                <ul style="padding-left: 20px;"> <!-- Lista con tabulación -->
                    <?php foreach ($subnetlist as $s): ?>
                        <li>
                            Subnet Name: <?= htmlspecialchars($s['nameSubnet']); ?><br>
                            Subnet IP: <?= htmlspecialchars($s['IP']); ?><br>
                            Subnet Cidr: <?= htmlspecialchars($s['cidr']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <p>Create Subnet: </p>
        </div>
    </div>
</body>