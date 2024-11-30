<!DOCTYPE html>
<html lang="en">

<?php
include "head.php";
require "classes/user.php";
require "classes/dataBase.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
}
$user = unserialize($_SESSION["user"]);
$privileges = $dataBase->getPrivilegesByUserGroupId($user->getIdUserGroup());
?>

<body>
    <?php include "navbar.php" ?>
    <div class="myAccountBody">
        <div class="myAccountMenu">
            <div>
                <a class="myAccountMenuItem" href="?page=myProfile.php">Profile</a>
                <?php

                if (in_array("Super Admin", $privileges)) {
                    echo '<a class="myAccountMenuItem" href="?page=myCompany.php">Company</a>';
                    echo '<a class="myAccountMenuItem" href="?page=myPayments.php">Payments</a>';
                    echo '<a class="myAccountMenuItem" href="?page=myUserGroups.php">User Groups</a>';
                    echo '<a class="myAccountMenuItem" href="?page=myUsers.php">Users</a>';
                    echo '<a class="myAccountMenuItem" href="?page=myConsole.php" style="color:green;">TotCloud Pannel</a>';
                } else {
                    if (in_array("Edit Company", $privileges)) {
                        echo '<a class="myAccountMenuItem" href="?page=myCompany.php">Company</a>';
                    }
                    if (in_array("View Payments", $privileges)) {
                        echo '<a class="myAccountMenuItem" href="?page=myPayments.php">Payments</a>';
                    }
                    if (in_array("Edit User Groups", $privileges) || in_array("Edit Privilegies", $privileges)) {
                        echo '<a class="myAccountMenuItem" href="?page=myUserGroups.php">User Groups</a>';
                    }
                    if (in_array("Edit Users", $privileges)) {
                        echo '<a class="myAccountMenuItem" href="?page=myUsers.php">Users</a>';
                    }
                }

                ?>
            </div>

            <a class="myAccountMenuItem" href="classes/logOut.php" style="color:red; font-weight:normal;">Log Out</a>
        </div>

        <div class="myAccountMain">
            <?php 
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    include $page;
                    unset($_GET['page']);
                }
            
            ?>
        </div>
    </div>
</body>

</html>