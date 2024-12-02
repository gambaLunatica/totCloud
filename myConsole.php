<?php
include "classes/image.php";
include "classes/memory.php";

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
                    <input value=<?= $cachel2Val ?> placeholder="0" min="0" max="256" type="number" id="cachel2"
                        name="cachel2">

                    <label for="cachel3">Cache L3 (MB):</label>
                    <input value=<?= $cachel3Val ?> placeholder="0" min="0" max="256" type="number" id="cachel3"
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

                    <label for="idMemories">Select Compatible Memories:</label>
                    <br>
                    <select multiple id="idMemories" name="idMemories[]" style="min-height: 150px;">
                    <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $memories = $dataBase->selectMemories(); // Ensure this returns an array
                        foreach ($memories as $memory) {
                            $idMemory = $memory->getIdMemory();
                            $speed = $memory->getIOSpeed();
                            $size = $memory->getTotalCapacity();
                            $generation = $memory->getGeneration();

                            $select = "";
                            if (in_array($idMemory , $idMemoriesVal)) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $idMemory . '">' . $generation . ' | ' . $size . 'GB | ' . $speed . 'GB/s</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="idImages">Select Compatible Images:</label>
                    <br>
                    <select multiple id="idImages" name="idImages[]" style="min-height: 150px;">
                    <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $images = $dataBase->selectImages(); // Ensure this returns an array
                        foreach ($images as $image) {
                            $idImage = $image->getIdImage();
                            $imageOsName = $image->getOsName();
                            $imageBuild = $image->getBuild();

                            $select = "";
                            if (in_array($idImage , $idImagesVal)) {
                                $select = "selected";
                            }

                            echo '<option ' . $select . ' value="' . $idImage . '">' . $imageOsName . ' | ' . $imageBuild . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>
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
                    <select id="idMemory" name="idMemory">
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

                    <button class="goButton" type="submit" name="action" value="load">Load</button>

                    <br><br>

                    <label for="totalCapacity">Select Size:</label>
                    <select id="totalCapacity" name="totalCapacity">
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
                    <select id="generation" name="generation">
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
                    <select id="IOSpeed" name="IOSpeed">
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

                    <br>
                    <button class="goButton" type="submit" name="action" value="add">Add</button>
                    <button class="goButton" type="submit" name="action" value="remove">Remove</button>
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

                            echo '<option ' . $select . ' value="' . $imageId . '">' . $imageOsName . ' | ' . $imageBuild . '</option>';
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

                    <br>
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

    <section class="configurableItemSection">
        <h2> Misc</h2>
        <details>
            <summary class="configurableItemTitle">Speed</summary>
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
            <summary class="configurableItemTitle">Size</summary>
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
    </section>
</div>