<!DOCTYPE html>
<html lang="en">

<?php 
include "head.php";

require "classes/dataBase.php";

if(!isset($_SESSION["error"])){
    $_SESSION["error"] = 0;
}

if(!isset($_SESSION["message"])){
    $_SESSION["message"] = "";
}

?>

<body>
    <?php include "navbar.php" ?>
    <main>

        <?php 
        if($_SESSION["error"] != 0){
            ?>
            <div class="errorBox">
                <?php
                echo $_SESSION["message"];
                ?>
            </div>
            <?php
            $_SESSION["error"] = 0;
            $_SESSION["message"] = "";
        }

        if (isset($_SESSION["user"])){
            include "userHome.php";
        } else{
            include "guestHome.php";
        } 
        ?>
    </main>
</body>

</html>