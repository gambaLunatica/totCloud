<?php
include "classes/userGroup.php";

$userGroups = $dataBase->selectUserGroups($dataBase->getCompany());
?>

<div>
    <h1>Users</h1>
    <div
        style="display:flex; justify-content: center;display: flex;align-items: center;flex-direction: column; margin-bottom:20px;">
        <div class="icon-circle">
            <i class="fa-solid fa-user-group"></i>
        </div>
    </div>
    <form autocomplete="off" action="classes/userAction.php" method="post">
        <div style="display:flex; flex-wrap:wrap; justify-content: center;">
            <div style="flex: 1 1 300px; max-width: 300px; margin: 10px 10px;">
                <label for="realName">Name</label> <br>
                <input autocomplete="off" type="text" id="realName" name="realName" required>
            </div>
            <div style="flex: 1 1 300px; max-width: 300px; margin: 10px 10px;">
                <label for="realSurname">Surname</label><br>
                <input autocomplete="off" type="text" id="realSurname" name="realSurname" required>
            </div>
            <div style="flex: 1 1 300px; max-width: 300px; margin: 10px 10px;">
                <label for="email">Email</label><br>
                <input autocomplete="off" type="email" id="email" name="email" required>
            </div>

            <div style="flex: 1 1 300px; max-width: 300px; margin: 10px 10px;">
                <label for="userGroup">User Group</label><br>
                <select id="userGroup" name="userGroup" required>
                    <option selected disabled="disabled" value="">Select an option</option>
                    <?php
                    foreach ($userGroups as $userGroup) {
                        $nameUserGroup = $userGroup->getName();
                        $idUserGroup = $userGroup->getId();

                        echo '<option value="' . $idUserGroup . '">' . $nameUserGroup . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div style="flex: 1 1 300px; max-width: 300px; margin: 10px 10px;">
                <label for="password">Password</label><br>
                <input autocomplete="off" type="password" id="password" name="password" required>
            </div>

        </div>
        <button class="goButton" name="action" value="add" type="submit">Add</button>
    </form>
    <h2>User list</h2>
    <div style="display:flex; flex-wrap:wrap; margin-top:20px;">

        <?php
        $users = $dataBase->selectUsers($dataBase->getCompany());
        foreach ($users as $user) {

            ?>
            <div style="width:220px; margin:10px; height:300px; background-color:#36393e; border-radius:6px;">
                <div
                    style="display:flex; justify-content:center;align-items: center;flex-direction: column; margin-top:20px;">
                    <div class="icon-circle-mid">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <div style="display:flex; justify-content:center;align-items: center; flex-wrap:wrap;">
                    <div
                        style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; margin-top:20px">
                        <p style="margin: 0; font-weight:bold;">
                            <?= $user->getRealName() ?>&nbsp<?= $user->getRealSurname() ?>
                        </p>
                        <p style="margin: 0; font-size: smaller; color: #7289da;"><?= $user->getEmail() ?></p>
                    </div>
                </div>
                <div>
                    <form action="classes/userAction.php" method="post">
                        <input style="display:none;" type="text" id="email" name="email" value=<?= '"' . $user->getEmail() . '"' ?>>

                        <select id="userGroup" name="userGroup" style="width:200px; margin-top:10px;" required>
                            <?php
                            foreach ($userGroups as $userGroup) {
                                $nameUserGroup = $userGroup->getName();
                                $idUserGroup = $userGroup->getId();

                                $selected = "";
                                if ($user->getIdUserGroup() == $idUserGroup) {
                                    $selected = "selected";
                                }

                                echo '<option ' . $selected . ' value="' . $idUserGroup . '">' . $nameUserGroup . '</option>';
                            }
                            ?>
                        </select>

                        <div style="display: flex; justify-content: center; gap: 10px; margin-top:10px;">
                            <button class="goButton" name="action" value="update" type="submit">Update</button>
                            <?php
                            if ($user->getNameCompany() == null) {
                                echo '<button class="goButton" name="action" value="remove" type="submit">Remove</button>';
                            }
                            ?>

                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>