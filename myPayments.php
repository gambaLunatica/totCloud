<?php
include "classes/userGroup.php";

$user = unserialize($_SESSION["user"]);
$company = ($dataBase->selectUserGroup($user->getIdUserGroup()))->getNameCompany();

$computeInstanceCosts = $dataBase->selectComputeInstanceCosts($company);
$vcnCosts = $dataBase->selectVCNCosts($company);
$storageCosts = $dataBase->selectStorageCosts($company);
$dbCosts = $dataBase->selectDatabaseCosts($company);
?>
<div>
    <h1>My Payments</h1>
    <div style="display:flex; justify-content: center;display: flex;align-items: center;flex-direction: column;">
        <div class="icon-circle">
            <i class="fa-solid fa-money-bill-wave"></i>
        </div>
    </div>
    <h2>Next Payment</h2>
    <details>
        <summary class="configurableItemTitle" title="Click to expand" style="list-style: none;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="text-align: left; white-space: nowrap;">Due date: 
                    <?php 
                        $date = new DateTime('first day of next month');
                        $date->modify('-1 day');
                        $lastDay = $date->format('d'); // Day
                        $month = $date->format('m');  // Full month name
                        $year = $date->format('Y');   // Year

                        echo "<b>$lastDay/$month/$year<b>";
                    ?>
                    </td>
                    <td style="text-align: center; width: 100%; padding: 0px 10px">
                        <div
                            style="border-bottom: 1px dashed white; padding-top: 10px; width: 100%; text-align: center;">

                        </div>
                    </td>
                    <td style="text-align: right; white-space: nowrap;">Right Column</td>
                </tr>
            </table>
        </summary>
        <div class="configurableItemContent">
            <table style="width: 100%; border-collapse: collapse;">

                <?php
                if ($computeInstanceCosts != null) {
                    echo '<tr>
                            <td style="text-align: left; white-space: nowrap;"><h3>Compute Instances</h3></td>
                            <td style="text-align: center; width: 100%; padding: 0px 10px"></td>
                            <td style="text-align: right; white-space: nowrap;"></td>
                        </tr>';

                    foreach ($computeInstanceCosts as $computeInstanceCost) {
                        $name = $computeInstanceCost["ComputeInstanceName"];
                        $cost = $computeInstanceCost["TotalCost"];
                        echo "<tr>
                                <td style='text-align: left; white-space: nowrap;'>&nbsp $name</td>
                                <td style='text-align: center; width: 100%; padding: 0px 10px'>
                                    <div style='border-bottom: 1px dashed #424549; padding-top: 10px; width: 100%; text-align: center;'></div>
                                </td>
                                <td style='text-align: right; white-space: nowrap;'>$cost €</td>
                            </tr>";
                    }
                }

                if ($vcnCosts != null) {
                    echo '<tr>
                            <td style="text-align: left; white-space: nowrap;"><h3>Virtual Networks</h3></td>
                            <td style="text-align: center; width: 100%; padding: 0px 10px"></td>
                            <td style="text-align: right; white-space: nowrap;"></td>
                        </tr>';

                    foreach ($vcnCosts as $vcnCost) {
                        $name = $vcnCost["vcn"];
                        $cost = $vcnCost["cost"];
                        echo "<tr>
                                <td style='text-align: left; white-space: nowrap;'>&nbsp $name</td>
                                <td style='text-align: center; width: 100%; padding: 0px 10px'>
                                    <div style='border-bottom: 1px dashed #424549; padding-top: 10px; width: 100%; text-align: center;'></div>
                                </td>
                                <td style='text-align: right; white-space: nowrap;'>$cost €</td>
                            </tr>";
                    }
                }

                if ($storageCosts != null) {
                    echo '<tr>
                            <td style="text-align: left; white-space: nowrap;"><h3>Storages</h3></td>
                            <td style="text-align: center; width: 100%; padding: 0px 10px"></td>
                            <td style="text-align: right; white-space: nowrap;"></td>
                        </tr>';

                    foreach ($storageCosts as $storageCost) {
                        $name = $storageCost["storage"];
                        $cost = $storageCost["cost"];
                        echo "<tr>
                                <td style='text-align: left; white-space: nowrap;'>&nbsp $name</td>
                                <td style='text-align: center; width: 100%; padding: 0px 10px'>
                                    <div style='border-bottom: 1px dashed #424549; padding-top: 10px; width: 100%; text-align: center;'></div>
                                </td>
                                <td style='text-align: right; white-space: nowrap;'>$cost €</td>
                            </tr>";
                    }
                }

                if ($dbCosts != null) {
                    echo '<tr>
                            <td style="text-align: left; white-space: nowrap;"><h3>Data Bases</h3></td>
                            <td style="text-align: center; width: 100%; padding: 0px 10px"></td>
                            <td style="text-align: right; white-space: nowrap;"></td>
                        </tr>';

                    foreach ($dbCosts as $dbCost) {
                        $name = $dbCost["db"];
                        $cost = $dbCost["cost"];
                        echo "<tr>
                                <td style='text-align: left; white-space: nowrap;'>&nbsp $name</td>
                                <td style='text-align: center; width: 100%; padding: 0px 10px'>
                                    <div style='border-bottom: 1px dashed #424549; padding-top: 10px; width: 100%; text-align: center;'></div>
                                </td>
                                <td style='text-align: right; white-space: nowrap;'>$cost €</td>
                            </tr>";
                    }
                }
                ?>

            </table>
        </div>
    </details>

</div>