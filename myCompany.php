<?php
include("classes/userGroup.php");
include("classes/company.php");

$user = unserialize($_SESSION["user"]);
$userGroup = $dataBase->selectUserGroup($user->getIdUserGroup());
$company = $dataBase->selectCompany($userGroup->getNameCompany());
?>

<div>
    <h1>My Company</h1>
    <form action="classes/myCompanyAction.php" method="post">
        <div style="display:flex; justify-content: space-evenly;">
            <div style="justify-content: center;display: flex;align-items: center;flex-direction: column;">
                <div class="icon-circle">
                    <i class="fa-solid fa-building"></i>
                </div>
                <h2><i class="fa-solid fa-building"></i>&nbsp <?php echo $company->getName(); ?></h2>
            </div>
        </div>

        <div style="display:flex; justify-content: center; margin-top:20px">
            <div>
                <label for="region">Country:</label><br>
                <select id="region" name="region" style="width:250px;" required>
                    <option selected disabled="disabled" value="">Select an option</option>
                    <?php
                    $regions = $dataBase->selectRegions();
                    foreach ($regions as $region) {
                        $selected = "";
                        if ($region === $company->getNameRegion()) {
                            $selected = "selected";
                        }
                        echo '<option ' . $selected . ' value="' . $region . '">' . $region . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>
        <button class="goButton" type="submit">Save</button>
    </form>
</div>