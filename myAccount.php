<!DOCTYPE html>
<html lang="en">

<?php
include "head.php";

if(!isset($_SESSION["user"])){header("Location: ../index.php");}
?>

<body>
    <?php include "navbar.php" ?>
    <div class="myAccountBody">
        <div class="myAccountMenu">
            <div>
                <a class="myAccountMenuItem" href="#">My Profile</a>
                <a class="myAccountMenuItem" href="#">Test</a>
                <a class="myAccountMenuItem" href="#">Test</a>
            </div>

            <a class="myAccountMenuItem" href="classes/logOut.php" style="color:red; font-weight:normal;">Log Out</a>
        </div>

        <div class="myAccountMain">
            A
        </div>
    </div>
</body>

</html>