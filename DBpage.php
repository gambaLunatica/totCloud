<!DOCTYPE html>
<html lang="en">

<?php
    include 'head.php';
    include 'classes/user.php';
    require "classes/dataBase.php";
?>

<body>
    <?php include 'navbar.php';?>
    
    <main>
        <?php
        if (isset($_SESSION["user"])){
                include "userDB.php";
            } else{
                include "guestDB.php";
            } 
        ?>
    </main>
</body>
</html>