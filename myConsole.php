<?php
include "classes/image.php";
include "classes/memory.php";
include "classes/mask.php";
include "classes/storage.php";
include "classes/MySQL.php";
include "classes/Postgrade.php";
include "classes/setting.php";

$costVal = '""';
$statusVal = '""';

//CPU
$cpuVal = '""';
$modelVal = '""';
$serieVal = '""';
$coreCountVal = '""';
$frequencyVal = '""';
$cachel1Val = '""';
$cachel2Val = '"0"';
$cachel3Val = '"0"';
$idMemoriesVal = [];
$idImagesVal = [];

//IMAGE
$imageIdVal = '""';
$osNameVal = '""';
$buildVal = '""';

//MEMORY
$idMemoryVal = '""';
$totalCapacityVal = '""';
$IOSpeedVal = '""';
$generationVal = '""';

//MASK
$cidrVal = '""';

//STORAGE
$idStorageVal = '""';
$typeNameVal = '""';
$nameStorageVal = '""';

//MySQL Postgrade
$idDBTypeSQLVal = '""';
$idDBTypePostgradeVal = '""';
$releaseDateVal = "'" . date('Y-m-d') . "'";
$versionVal = '""';

//SETTING
$idSettingVal = '""';
$nameSettingVal = '""';
$stringValueVal = '""';
$decimalValueVal = '""';
$booleanValueVal = '""';

//CPU
if (isset($_GET['cpu'])) {
    $cpuVal = $_GET['cpu'];
    $modelVal = $_GET['model'];
    $serieVal = $_GET['serie'];
    $coreCountVal = $_GET['coreCount'];
    $frequencyVal = $_GET['frequency'];
    $cachel1Val = $_GET['cachel1'];
    $cachel2Val = $_GET['cachel2'];
    $cachel3Val = $_GET['cachel3'];
    $statusVal = $_GET['status'];
    $costVal = $_GET['cost'];
    $idMemoriesVal = $_GET['idMemories'];
    $idImagesVal = $_GET['idImages'];
} else if (isset($_GET['imageId'])) {
    $imageIdVal = $_GET['imageId'];
    $statusVal = $_GET['status'];
    $osNameVal = $_GET['osName'];
    $costVal = $_GET['cost'];
    $buildVal = $_GET['build'];
} else if (isset($_GET['idMemory'])) {
    $idMemoryVal = $_GET['idMemory'];
    $totalCapacityVal = $_GET['totalCapacity'];
    $IOSpeedVal = $_GET['IOSpeed'];
    $generationVal = $_GET['generation'];
    $costVal = $_GET['cost'];
    $statusVal = $_GET['status'];
} else if (isset($_GET['cidr'])) {
    $cidrVal = $_GET['cidr'];
    $costVal = $_GET['cost'];
} else if (isset($_GET['idStorage'])) {
    $idStorageVal = $_GET['idStorage'];
    $totalCapacityVal = $_GET['totalCapacity'];
    $IOSpeedVal = $_GET['IOSpeed'];
    $typeNameVal = $_GET['typeName'];
    $nameStorageVal = $_GET['nameStorage'];
    $costVal = $_GET['cost'];
    $statusVal = $_GET['status'];
} else if (isset($_GET['idDBTypeSQL'])) {
    $idDBTypeSQLVal = $_GET['idDBTypeSQL'];
    $releaseDateVal = "'" . $_GET['releaseDate'] . "'";
    $versionVal = $_GET['version'];
    $costVal = $_GET['cost'];
    $statusVal = $_GET['status'];
} else if (isset($_GET['idDBTypePostgrade'])) {
    $idDBTypePostgradeVal = $_GET['idDBTypePostgrade'];
    $releaseDateVal = "'" . $_GET['releaseDate'] . "'";
    $buildVal = $_GET['build'];
    $costVal = $_GET['cost'];
    $statusVal = $_GET['status'];
} else if (isset($_GET['idSetting'])) {
    $idSettingVal = $_GET['idSetting'];
    $nameSettingVal = $_GET['nameSetting'];
    $idDBTypePostgradeVal = $_GET['idDBTypePostgrade'];
    $idDBTypeSQLVal = $_GET['idDBTypeSQL'];
    $stringValueVal = $_GET['stringValue'];
    $decimalValueVal = $_GET['decimalValue'];
    $booleanValueVal = $_GET['booleanValue'];
    $statusVal = $_GET['status'];
}
?>

<div>
    <h1>TotCloud Configuration Console</h1>
    <section class="configurableItemSection">
        <h2> Compute Configuration</h2>

        <!--  CPU  -->
        <details>
            <summary class="configurableItemTitle">CPU</summary>
            <div class="configurableItemContent">
                <form action="classes/cpuAction.php" method="POST">
                    <h4>CPU Details</h4>

                    <label for="cpu">Select Model:</label>
                    <select id="cpu" name="cpu" required>
                        <option value="--New--">--New--</option>
                        <?php
                        $CPUs = $dataBase->selectCPUs(); // Ensure this returns an array
                        foreach ($CPUs as $CPU) {
                            $select = "";
                            if (strcmp($cpuVal, $CPU) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $CPU . '">' . $CPU . '</option>';
                        }
                        ?>
                    </select>

                    <button formnovalidate class="goButton" type="submit" name="action" value="load">Load</button>

                    <br><br>

                    <label for="model">Model:</label>
                    <input value=<?= $modelVal ?> type="text" id="model" name="model" required>

                    <br>

                    <label for="serie">Series:</label>
                    <select id="serie" name="serie" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $series = $dataBase->selectSeries(); // Ensure this returns an array
                        foreach ($series as $serie) {
                            $select = "";
                            if (strcmp($serie, $serieVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $serie . '">' . $serie . '</option>';
                        }
                        ?>
                    </select>

                    <label for="coreCount">Core Count:</label>
                    <input value=<?= $coreCountVal ?> min="1" max="256" type="number" id="coreCount" name="coreCount"
                        required>

                    <br>

                    <label for="frequency">Frequency (GHz):</label>
                    <input value=<?= $frequencyVal ?> min="0.5" max="6" step="0.01" type="number" id="frequency"
                        name="frequency" required>

                    <br><br>

                    <label for="cachel1">Cache L1 (MB):</label>
                    <input value=<?= $cachel1Val ?> min="1" max="256" type="number" id="cachel1" name="cachel1" required>

                    <label for="cachel2">Cache L2 (MB):</label>
                    <input value=<?= $cachel2Val ?> placeholder="0" min="0" max="256" type="number" id="cachel2"
                        name="cachel2" required>

                    <label for="cachel3">Cache L3 (MB):</label>
                    <input value=<?= $cachel3Val ?> placeholder="0" min="0" max="256" type="number" id="cachel3"
                        name="cachel3" required>

                    <br><br>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $statuss = $dataBase->selectStatus(); // Ensure this returns an array
                        foreach ($statuss as $status) {
                            $select = "";
                            if (strcmp($status, $statusVal) === 0) {
                                $select = "selected";
                            }
                            echo '<option ' . $select . ' value="' . $status . '">' . $status . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="cost">Sales Price:</label>
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <h3>CPU Compatibility</h3>

                    <label for="idMemories">Select Compatible Memories:</label>
                    <br>
                    <select multiple id="idMemories" name="idMemories[]" style="min-height: 150px;" required>
                        <option disabled="disabled" value="">Select an option</option>
                        <?php
                        $memories = $dataBase->selectMemories(); // Ensure this returns an array
                        foreach ($memories as $memory) {
                            $idMemory = $memory->getIdMemory();
                            $speed = $memory->getIOSpeed();
                            $size = $memory->getTotalCapacity();
                            $generation = $memory->getGeneration();

                            $select = "";
                            if (in_array($idMemory, $idMemoriesVal)) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $idMemory . '">' . $generation . ' | ' . $size . 'GB | ' . $speed . 'GB/s</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="idImages">Select Compatible Images:</label>
                    <br>
                    <select multiple id="idImages" name="idImages[]" style="min-height: 150px;" required>
                        <option disabled="disabled" value="">Select an option</option>
                        <?php
                        $images = $dataBase->selectImages(); // Ensure this returns an array
                        foreach ($images as $image) {
                            $idImage = $image->getIdImage();
                            $imageOsName = $image->getOsName();
                            $imageBuild = $image->getBuild();

                            $select = "";
                            if (in_array($idImage, $idImagesVal)) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $idImage . '">' . $imageOsName . ' | ' . $imageBuild . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove" formnovalidate>Remove</button>
                </form>
            </div>
        </details>

        <!--  Series  -->
        <details>
            <summary class="configurableItemTitle">Series</summary>
            <div class="configurableItemContent">
                <form action="classes/seriesAction.php" method="POST">
                    <h4>Add/Remove a Series</h4>

                    <label for="series">Name:</label>
                    <input type="text" id="series" name="series" required>
                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>

        <!--  Memory  -->
        <h3>Memory Configuration</h3>

        <details>
            <summary class="configurableItemTitle">Generation</summary>
            <div class="configurableItemContent">
                <form action="classes/generationAction.php" method="POST">
                    <h4>Add/Remove a Generation</h4>

                    <label for="generation">Name:</label>
                    <input type="text" id="generation" name="generation" required>
                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>

        <details>
            <summary class="configurableItemTitle">Memory</summary>
            <div class="configurableItemContent">
                <form action="classes/memoryAction.php" method="POST">
                    <h4>Memory Details</h4>

                    <label for="idMemory">Select Memory:</label>
                    <select id="idMemory" name="idMemory" required>
                        <option value="--New--">--New--</option>
                        <?php
                        $memories = $dataBase->selectMemories(); // Ensure this returns an array
                        foreach ($memories as $memory) {
                            $idMemory = $memory->getIdMemory();
                            $speed = $memory->getIOSpeed();
                            $size = $memory->getTotalCapacity();
                            $generation = $memory->getGeneration();

                            $select = "";
                            if (strcmp($idMemoryVal, $idMemory) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $idMemory . '">' . $generation . ' | ' . $size . 'GB | ' . $speed . 'GB/s</option>';
                        }
                        ?>
                    </select>

                    <button class="goButton" type="submit" name="action" value="load" formnovalidate>Load</button>

                    <br><br>

                    <label for="totalCapacity">Select Size:</label>
                    <select id="totalCapacity" name="totalCapacity" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $sizes = $dataBase->selectSizes(); // Ensure this returns an array
                        foreach ($sizes as $size) {

                            $select = "";
                            if (strcmp($totalCapacityVal, $size) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $size . '">' . $size . 'GB' . '</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="generation">Select Generation:</label>
                    <select id="generation" name="generation" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $generations = $dataBase->selectGenerations(); // Ensure this returns an array
                        foreach ($generations as $generation) {

                            $select = "";
                            if (strcmp($generation, $generationVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $generation . '">' . $generation . '</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="IOSpeed">Select Speed:</label>
                    <select id="IOSpeed" name="IOSpeed" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $speeds = $dataBase->selectSpeeds(); // Ensure this returns an array
                        foreach ($speeds as $speed) {

                            $select = "";
                            if (strcmp($speed, $IOSpeedVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $speed . '">' . $speed . 'GB/s' . '</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $statuss = $dataBase->selectStatus(); // Ensure this returns an array
                        foreach ($statuss as $status) {
                            $select = "";
                            if (strcmp($status, $statusVal) === 0) {
                                $select = "selected";
                            }
                            echo '<option ' . $select . ' value="' . $status . '">' . $status . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="cost">Sales Price:</label>
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove" formnovalidate>Remove</button>
                </form>
            </div>
        </details>

        <!--  OS  -->
        <h3>Image Configuration</h3>

        <details>
            <summary class="configurableItemTitle">Operating System</summary>
            <div class="configurableItemContent">
                <form action="classes/osAction.php" method="POST">
                    <h4>Add/Remove an Operating System</h4>

                    <label for="os">Name:</label>
                    <input type="text" id="os" name="os" required>
                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>

        <!--  Image  -->
        <details>
            <summary class="configurableItemTitle">Image</summary>
            <div class="configurableItemContent">
                <form action="classes/imageAction.php" method="POST">
                    <h4>Image Details</h4>

                    <label for="imageId">Select Image:</label>
                    <select id="imageId" name="imageId" required>
                        <option value="--New--">--New--</option>
                        <?php
                        $images = $dataBase->selectImages(); // Ensure this returns an array
                        foreach ($images as $image) {
                            $imageId = $image->getIdImage();
                            $imageOsName = $image->getOsName();
                            $imageBuild = $image->getBuild();

                            $select = "";
                            if (strcmp($imageIdVal, $imageId) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $imageId . '">' . $imageOsName . ' | ' . $imageBuild . '</option>';
                        }
                        ?>
                    </select>

                    <button class="goButton" type="submit" name="action" value="load" formnovalidate>Load</button>

                    <br><br>

                    <label for="build">Build:</label>
                    <input value=<?= $buildVal ?> type="text" id="build" name="build" required>

                    <br>

                    <label for="osName">Operating System:</label>
                    <select id="osName" name="osName" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $osNames = $dataBase->selectOS();
                        foreach ($osNames as $osName) {
                            $select = "";
                            if (strcmp($osName, $osNameVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $osName . '">' . $osName . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $statuss = $dataBase->selectStatus(); // Ensure this returns an array
                        foreach ($statuss as $status) {
                            $select = "";
                            if (strcmp($status, $statusVal) === 0) {
                                $select = "selected";
                            }
                            echo '<option ' . $select . ' value="' . $status . '">' . $status . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="cost">Sales Price:</label>
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove" formnovalidate>Remove</button>
                </form>
            </div>
        </details>
    </section>

    <section class="configurableItemSection">
        <h2> Storage Configuration</h2>
        <details>
            <summary class="configurableItemTitle">Type</summary>
            <div class="configurableItemContent">
                <form action="classes/typeAction.php" method="POST">
                    <h4>Add/Remove Type</h4>

                    <label for="type">Type:</label>
                    <input type="text" id="type" name="type" required>
                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>

        <details>
            <summary class="configurableItemTitle">Storage</summary>
            <div class="configurableItemContent">
                <form action="classes/storageAction.php" method="POST">
                    <h4>Storage Details</h4>

                    <label for="idStorage">Select Storage:</label>
                    <select id="idStorage" name="idStorage" required>
                        <option value="--New--">--New--</option>
                        <?php
                        $storages = $dataBase->selectStorages(); // Ensure this returns an array
                        foreach ($storages as $storage) {
                            $nameStorage = $storage->getNameStorage();

                            $select = "";
                            if (strcmp($nameStorage, $idStorageVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $nameStorage . '">' . $nameStorage . '</option>';
                        }
                        ?>
                    </select>

                    <button class="goButton" type="submit" name="action" value="load" formnovalidate>Load</button>

                    <br><br>

                    <label for="nameStorage">Name:</label>
                    <input value=<?= $nameStorageVal ?> type="text" id="nameStorage" name="nameStorage" required>

                    <br><br>

                    <label for="totalCapacity">Select Size:</label>
                    <select id="totalCapacity" name="totalCapacity" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $sizes = $dataBase->selectSizes(); // Ensure this returns an array
                        foreach ($sizes as $size) {

                            $select = "";
                            if (strcmp($totalCapacityVal, $size) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $size . '">' . $size . 'GB' . '</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="typeName">Select Type:</label>
                    <select id="typeName" name="typeName" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $types = $dataBase->selectTypes(); // Ensure this returns an array
                        foreach ($types as $type) {

                            $select = "";
                            if (strcmp($type, $typeNameVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $type . '">' . $type . '</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="IOSpeed">Select Speed:</label>
                    <select id="IOSpeed" name="IOSpeed" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $speeds = $dataBase->selectSpeeds(); // Ensure this returns an array
                        foreach ($speeds as $speed) {

                            $select = "";
                            if (strcmp($speed, $IOSpeedVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $speed . '">' . $speed . 'GB/s' . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $statuss = $dataBase->selectStatus(); // Ensure this returns an array
                        foreach ($statuss as $status) {
                            $select = "";
                            if (strcmp($status, $statusVal) === 0) {
                                $select = "selected";
                            }
                            echo '<option ' . $select . ' value="' . $status . '">' . $status . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="cost">Sales Price:</label>
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove" formnovalidate>Remove</button>
                </form>
            </div>
        </details>
    </section>

    <section class="configurableItemSection">
        <h2> VCN Configuration</h2>
        <details>
            <summary class="configurableItemTitle">Mask</summary>
            <div class="configurableItemContent">
                <form action="classes/maskAction.php" method="POST">
                    <h4>Mask Details</h4>

                    <label for="cidrId">Select Mask:</label>
                    <select id="cidrId" name="cidrId" required>
                        <option value="--New--">--New--</option>
                        <?php
                        $masks = $dataBase->selectMasks(); // Ensure this returns an array
                        foreach ($masks as $mask) {
                            $cidr = $mask->getCidr();

                            $select = "";
                            if (strcmp($cidrVal, $cidr) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $cidr . '">CIDR: ' . $cidr . '</option>';
                        }
                        ?>
                    </select>

                    <button class="goButton" type="submit" name="action" value="load" formnovalidate>Load</button>

                    <br><br>

                    <label for="cidr">CIDR:</label>
                    <input value=<?= $cidrVal ?> min="16" step="1" max="30" type="number" id="cidr" name="cidr" required>

                    <label for="cost">Sales Price:</label>
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove" formnovalidate>Remove</button>
                </form>
            </div>
        </details>
    </section>

    <section class="configurableItemSection">
        <h2> DDBB Configuration</h2>
        <details>
            <summary class="configurableItemTitle">MySQL</summary>
            <div class="configurableItemContent">
                <form action="classes/mySQLAction.php" method="POST">
                    <h4>MySQL Details</h4>

                    <label for="idDBTypeSQL">Select MySQL:</label>
                    <select id="idDBTypeSQL" name="idDBTypeSQL" required>
                        <option value="--New--">--New--</option>
                        <?php
                        $mySQLs = $dataBase->selectMySQLs(); // Ensure this returns an array
                        foreach ($mySQLs as $mySQL) {
                            $IdDBType = $mySQL->getIdDBType();
                            $version = $mySQL->getVersion();

                            $select = "";
                            if (strcmp($IdDBType, $idDBTypeSQLVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $IdDBType . '"> MySQL v.' . $version . '</option>';
                        }
                        ?>
                    </select>

                    <button class="goButton" type="submit" name="action" value="load" formnovalidate>Load</button>

                    <br><br>

                    <label for="version">Version:</label>
                    <input value=<?= $versionVal ?> type="text" id="version" name="version" required>

                    <label for="releaseDate">Release Date:</label>
                    <input value=<?= $releaseDateVal ?>type="date" id="releaseDate" name="releaseDate">

                    <br><br>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $statuss = $dataBase->selectStatus(); // Ensure this returns an array
                        foreach ($statuss as $status) {
                            $select = "";
                            if (strcmp($status, $statusVal) === 0) {
                                $select = "selected";
                            }
                            echo '<option ' . $select . ' value="' . $status . '">' . $status . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="cost">Sales Price:</label>
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove" formnovalidate>Remove</button>
                </form>
            </div>
        </details>

        <details>
            <summary class="configurableItemTitle">Postgre</summary>
            <div class="configurableItemContent">
                <form action="classes/postgradeAction.php" method="POST">
                    <h4>Postgre Details</h4>

                    <label for="idDBTypePostgrade">Select Postgre:</label>
                    <select id="idDBTypePostgrade" name="idDBTypePostgrade" required>
                        <option value="--New--">--New--</option>
                        <?php
                        $postgrades = $dataBase->selectPostgrades(); // Ensure this returns an array
                        foreach ($postgrades as $postgrade) {
                            $IdDBType = $postgrade->getIdDBType();
                            $build = $postgrade->getBuild();

                            $select = "";
                            if (strcmp($IdDBType, $idDBTypePostgradeVal) === 0) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $IdDBType . '"> Postgre (' . $build . ')</option>';
                        }
                        ?>
                    </select>

                    <button class="goButton" type="submit" name="action" value="load" formnovalidate>Load</button>

                    <br><br>

                    <label for="build">Build:</label>
                    <input value=<?= $buildVal ?> type="text" id="build" name="build" required>

                    <label for="releaseDate">Release Date:</label>
                    <input value=<?= $releaseDateVal ?>type="date" id="releaseDate" name="releaseDate">

                    <br><br>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $statuss = $dataBase->selectStatus(); // Ensure this returns an array
                        foreach ($statuss as $status) {
                            $select = "";
                            if (strcmp($status, $statusVal) === 0) {
                                $select = "selected";
                            }
                            echo '<option ' . $select . ' value="' . $status . '">' . $status . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="cost">Sales Price:</label>
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove" formnovalidate>Remove</button>
                </form>
            </div>
        </details>

        <details>
            <summary class="configurableItemTitle">Data Base Settings</summary>
            <div class="configurableItemContent">
                <form action="classes/settingAction.php" method="POST">
                    <h4>Setting Details</h4>

                    <label for="idSetting">Select Setting:</label>
                    <select id="idSetting" name="idSetting" required>
                        <option value="--New--">--New--</option>
                        <?php
                        $settings = $dataBase->selectSettings(); // Ensure this returns an array
                        foreach ($settings as $setting) {
                            $nameSetting = $setting->getNameSetting();

                            $postgre = $setting->getIdDBTypePostgrade();
                            $mySQL = $setting->getIdDBTypeMySQL();

                            if ($postgre > 0 && $mySQL >0) {
                                $displayName = "(MySQL | Postgre)";
                            } else if ($postgre > 0) {
                                $displayName = "(Postgre)";
                            } else if ($mySQL > 0) {
                                $displayName = "(MySQL)";
                            }

                            $displayName = $nameSetting . " " . $displayName;

                            echo '<option value="' . $nameSetting . '">' . $displayName . '</option>';
                        }
                        ?>
                    </select>

                    <h4>Select Data Base Type:</h4>
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


                    <br><br>

                    <label for="nameSetting">Name:</label>
                    <input type="text" id="nameSetting" name="nameSetting" required>

                    <br>

                    <h4>Default Values</h4>

                    <label for="stringValue">Text Value:</label>
                    <input type="text" id="stringValue" name="stringValue">

                    <label for="decimalValue">Numeric Value:</label>
                    <input type="text" id="decimalValue" name="decimalValue">

                    <label for="booleanValue">Boolean Value:</label>
                    <select id="booleanValue" name="booleanValue">
                        <option selected value="">Select an option</option>
                        <option value="true">TRUE</option>
                        <option value="false">FALSE</option>

                    </select>

                    <br><br>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $statuss = $dataBase->selectStatus(); // Ensure this returns an array
                        foreach ($statuss as $status) {
                            echo '<option value="' . $status . '">' . $status . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove" formnovalidate>Remove</button>
                </form>
            </div>
        </details>
    </section>

    <section class="configurableItemSection">
        <h2> Misc</h2>
        <details>
            <summary class="configurableItemTitle">Speeds</summary>
            <div class="configurableItemContent">
                <form action="classes/speedAction.php" method="POST">
                    <h4>Add/Remove a Speed (GB/s)</h4>

                    <label for="speed">Speed:</label>
                    <input type="number" step="0.01" id="speed" name="speed" required>
                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>

        <details>
            <summary class="configurableItemTitle">Sizes</summary>
            <div class="configurableItemContent">
                <form action="classes/sizeAction.php" method="POST">
                    <h4>Add/Remove a Size (GB)</h4>

                    <label for="size">Size:</label>
                    <input type="number" step="0.01" id="size" name="size" required>
                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>

        <details>
            <summary class="configurableItemTitle">Regions</summary>
            <div class="configurableItemContent">
                <form action="classes/regionAction.php" method="POST">
                    <h4>Add/Remove a Region</h4>

                    <label for="regionName">Country:</label>
                    <input type="text" id="regionName" name="regionName" size="32" required>
                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>
    </section>
</div>