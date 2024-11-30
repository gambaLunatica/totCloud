<?php
include "classes/image.php";

$costVal = '""';
$statusVal = '""';

//CPU
$cpuVal = '""';
$modelVal = '""';
$serieVal = '""';
$coreCountVal = '""';
$frequencyVal = '""';
$cachel1Val = '""';
$cachel2Val = '""';
$cachel3Val = '""';

//IMAGE
$imageIdVal= '""';
$osNameVal= '""';
$buildVal= '""';

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
} else if (isset($_GET['imageId'])) {
    $imageIdVal = $_GET['imageId'];
    $statusVal = $_GET['status'];
    $osNameVal = $_GET['osName'];
    $costVal = $_GET['cost'];
    $buildVal  = $_GET['build'];
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
                    <h3>CPU Details</h3>

                    <label for="cpu">Select Model:</label>
                    <select id="cpu" name="cpu">
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

                    <button class="goButton" type="submit" name="action" value="load">Load</button>

                    <br><br>

                    <label for="model">Model:</label>
                    <input value=<?= $modelVal ?> type="text" id="model" name="model">

                    <br>

                    <label for="serie">Series:</label>
                    <select id="serie" name="serie">
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
                    <input value=<?= $coreCountVal ?> min="1" max="256" type="number" id="coreCount" name="coreCount">

                    <br>

                    <label for="frequency">Frequency (GHz):</label>
                    <input value=<?= $frequencyVal ?> min="0.5" max="6" step="0.01" type="number" id="frequency"
                        name="frequency">

                    <br><br>

                    <label for="cachel1">Cache L1 (MB):</label>
                    <input value=<?= $cachel1Val ?> min="1" max="256" type="number" id="cachel1" name="cachel1">

                    <label for="cachel2">Cache L2 (MB):</label>
                    <input value=<?= $cachel2Val ?> placeholder="0" min="1" max="256" type="number" id="cachel2"
                        name="cachel2">

                    <label for="cachel3">Cache L3 (MB):</label>
                    <input value=<?= $cachel3Val ?> placeholder="0" min="1" max="256" type="number" id="cachel3"
                        name="cachel3">

                    <br><br>

                    <label for="status">Status:</label>
                    <select id="status" name="status">
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
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost">

                    <h3>CPU Compatibility</h3>

                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>

        <!--  Series  -->
        <details>
            <summary class="configurableItemTitle">Series</summary>
            <div class="configurableItemContent">
                <form action="classes/seriesAction.php" method="POST">
                    <h3>Add/Remove a Series</h3>

                    <label for="series">Name:</label>
                    <input type="text" id="series" name="series" required>
                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>

        <!--  Memory  -->
        <details>
            <summary class="configurableItemTitle">Memory</summary>
            <div class="configurableItemContent">
                <form action="submit_item.php" method="POST">
                    <h3>Memory Details</h3>

                    <label for="cpu">Select Model:</label>
                    <select id="cpu" name="cpu" required onchange="handleDropdownChange()">
                        <option value="--New--">--New--</option>
                        <?php
                        $CPUs = $dataBase->selectCPUs(); // Ensure this returns an array
                        foreach ($CPUs as $CPU) {
                            echo '<option value="' . htmlspecialchars($CPU, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($CPU, ENT_QUOTES, 'UTF-8') . '</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="serie">Series:</label>
                    <select id="serie" name="serie" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $series = $dataBase->selectSeries(); // Ensure this returns an array
                        foreach ($series as $serie) {
                            echo '<option value="' . htmlspecialchars($serie, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($serie, ENT_QUOTES, 'UTF-8') . '</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="serie">Series:</label>
                    <select id="serie" name="serie" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $series = $dataBase->selectSeries(); // Ensure this returns an array
                        foreach ($series as $serie) {
                            echo '<option value="' . htmlspecialchars($serie, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($serie, ENT_QUOTES, 'UTF-8') . '</option>';
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
                            echo '<option value="' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="cost">Sales Price:</label>
                    <input min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <button type="submit">Submit</button>
                </form>
            </div>
        </details>
        
        <!--  OS  -->
        <details>
            <summary class="configurableItemTitle">Operating System</summary>
            <div class="configurableItemContent">
                <form action="classes/osAction.php" method="POST">
                    <h3>Add/Remove an Operating System</h3>

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
                    <h3>Image Details</h3>

                    <label for="imageId">Select Image:</label>
                    <select id="imageId" name="imageId">
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

                            echo '<option ' .$select. ' value="' . $imageId . '">' . $imageOsName . ' | ' . $imageBuild . '</option>';
                        }
                        ?>
                    </select>

                    <button class="goButton" type="submit" name="action" value="load">Load</button>

                    <br><br>

                    <label for="build">Build:</label>
                    <input value=<?= $buildVal ?> type="text" id="build" name="build">

                    <br>

                    <label for="osName">Operating System:</label>
                    <select id="osName" name="osName">
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
                    <select id="status" name="status">
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
                    <input value=<?= $costVal ?> min="0" step="0.01" type="number" id="cost" name="cost">

                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
                </form>
            </div>
        </details>
    </section>

    <section class="configurableItemSection">
        <h2> Storage Configuration</h2>
        <details>
            <summary class="configurableItemTitle">CPU</summary>
            <div class="configurableItemContent">
                Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international
                pavilions, award-winning fireworks and seasonal special events.
            </div>
        </details>
    </section>

    <section class="configurableItemSection">
        <h2> Compute Configuration</h2>
        <details>
            <summary class="configurableItemTitle">CPU</summary>
            <div class="configurableItemContent">
                Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international
                pavilions, award-winning fireworks and seasonal special events.
            </div>
        </details>
    </section>
</div>