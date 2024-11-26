<?php
session_start();
require "classes/dataBase.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body>
    <?php include "navbar.php" ?>
    <main>
        <?php if (isset($_SESSION["user"])){
            include "userHome.php";
        } else{
            include "guestHome.php";
        } ?>
    </main>
</body>

</html>