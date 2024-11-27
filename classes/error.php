<!DOCTYPE html>
<html lang="en">

<?php
function displayError(string $error)
{
    ?>

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TotCloud</title>
        <link rel="stylesheet" href="../css/styles.css"> <!-- Link to your CSS file -->
        <link rel="icon" href="totCloud.ico"> <!-- Optional favicon -->

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a603bf3adf.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php include "../navbar.php" ?>
        <main>
            <div class="errorBox">
                <?php
                echo $error;
                ?>
            </div>
        </main>
    </body>
    <?php
}
?>

</html>