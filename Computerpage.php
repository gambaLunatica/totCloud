<!DOCTYPE html>
<html lang="en">

<?php
    include 'head.php';
    require "classes/dataBase.php";
?>

<body>
    <?php include 'navbar.php';?>
    
    <main>
        <?php
        if (isset($_SESSION["user"])){
                include "userComputer.php";
            } else{
                include "guestComputer.php";
            } 
        ?>
    </main>
</body>
</html>