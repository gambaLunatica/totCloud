<?php
include 'head.php';
include "classes/MySQL.php";
include "classes/Postgrade.php";
include "classes/DataBase.php";

//MySQL Postgrade
$idDBTypeSQLVal = '""';
$idDBTypePostgradeVal = '""';
$releaseDateVal = "'" . date('Y-m-d') . "'";
$versionVal = '""';
?>
<body>
<?php include 'navbar.php';?>
<div class="newProd-container">
    <h1>Database Configuration</h1>
    <br><br>
    <label for="nameSetting">Name:</label>
    <input type="text" id="nameSetting" name="nameSetting" required>
    <br><br>
    <label for="idDBTypePostgrade">Postgrade Version:</label>
    <select id="idDBTypePostgrade" name="idDBTypePostgrade">
        <option selected value="">Select an option</option>
        <?php
        $postgrades = $dataBase->selectPostgrades(); // Ensure this returns an array
        foreach ($postgrades as $postgrade) {
            $build = $postgrade->getBuild();
            $IdDBTypeP = $postgrade->getIdDBType();

            echo '<option value="' . $IdDBTypeP . '"> Postgre (' . $build . ')</option>';
        }
        ?>
    </select>
    <br>
    <label for="idDBTypeSQL">MySQL Version:</label>
    <select id="idDBTypeSQL" name="idDBTypeSQL">
        <option selected value="">Select an option</option>
        <?php
        $mySQLs = $dataBase->selectMySQLs(); // Ensure this returns an array
        foreach ($mySQLs as $mySQL) {
            $IdDBTypeS = $mySQL->getIdDBType();
            $version = $mySQL->getVersion();

            echo '<option value="' . $IdDBTypeS . '"> MySQL v.' . $version . '</option>';
        }
        ?>
    </select>
</div>
</body>