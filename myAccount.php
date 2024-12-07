<!DOCTYPE html>
<html lang="en">

<?php
include "head.php";
require "classes/user.php";
require "classes/dataBase.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
}
?>

<body>
    <?php include "navbar.php" ?>
    <div class="myAccountBody">
        <div class="myAccountMenu">
            <div>
                <a class="myAccountMenuItem" href="?page=myProfile.php"><i class="fa-solid fa-user"></i>&nbsp
                    Profile</a>
                <?php
                if ($dataBase->canEditCompany()) {
                    echo '<a class="myAccountMenuItem" href="?page=myCompany.php"><i class="fa-solid fa-building"></i> &nbsp Company</a>';
                }
                if ($dataBase->canViewPayments()) {
                    echo '<a class="myAccountMenuItem" href="?page=myPayments.php"><i class="fa-solid fa-money-bill-wave"></i> &nbsp Payments</a>';
                }
                if ($dataBase->canEditUserGroup()) {
                    echo '<a class="myAccountMenuItem" href="?page=myUserGroups.php"><i class="fa-solid fa-layer-group"></i> &nbsp User Groups</a>';
                }
                if ($dataBase->canEditUsers()) {
                    echo '<a class="myAccountMenuItem" href="?page=myUsers.php"><i class="fa-solid fa-user-group"></i> &nbsp Users</a>';
                }

                ?>
            </div>

            <a class="myAccountMenuItem" href="classes/logOut.php" style="color:red; font-weight:normal;">Log Out</a>
        </div>

        <div class="myAccountMain">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                include $page;
                unset($_GET['page']);
            }

            ?>
        </div>
    </div>
</body>

</html>