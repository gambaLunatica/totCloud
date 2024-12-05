<?php
include("classes/userGroup.php");

$user = unserialize($_SESSION["user"]);
$userGroup = $dataBase->selectUserGroup($user->getIdUserGroup());
$name = $user->getRealName();
$lastname = $user->getRealSurname();
$email = $user->getEmail();
?>

<div>
    <h1>My Profile</h1>
    <form action="classes/myProfileAction.php" method="post">
    <div style="display:flex; justify-content: space-evenly;">
        <div style="justify-content: center;display: flex;align-items: center;flex-direction: column;">
            <div class="icon-circle">
                <i class="fa-solid fa-user"></i>
            </div>
            <p><i class="fa-solid fa-building"></i>&nbsp
                Company:<?php echo "&nbsp" . $userGroup->getNameCompany() . "<br><br><i class='fa-solid fa-layer-group'></i> &nbsp  User Group: " . $userGroup->getName(); ?>
        </div>

        <div>

            <label for="name">Name:</label><br>
            <input type="text" value=<?= "'" . $name . "'" ?> id="name" name="name" required><br><br>

            <label for="surname">Surname:</label><br>
            <input type="text" value=<?= "'" . $lastname . "'" ?> id="surname" name="surname" required><br><br>

            <label for="email">Email:</label><br>
            <input disabled type="email" value=<?= "'" . $email . "'" ?> id="email" name="email" required><br><br>



        </div>
    </div>

    <div style="display:flex; justify-content: space-around; margin-top:20px">
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </div>


        <div>
            <label for="confirm_password">Repeat Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
    </div>
    <br>
    <button class="goButton" type="submit" formnovalidate>Save</button>
    </form>
</div>