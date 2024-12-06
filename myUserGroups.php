<div>
    <h1>My User Groups</h1>
    <div style="display:flex; justify-content: center;display: flex;align-items: center;flex-direction: column;">
        <div class="icon-circle">
            <i class="fa-solid fa-layer-group"></i>
        </div>
    </div>
    <div>
        <h2>Add User Groups</h2>
        <div>
            <form action="classes/signupAction.php" method="post">
                <div>
                    <div style="">
                        <label for="nameUserGroup">Name</label>
                        <input type="text" id="nameUserGroup" name="nameUserGroup" required>
                    </div>
                    <div style="display:flex;">
                        <label for="viewPayments">
                            <input type="checkbox" id="viewPayments" name="viewPayments">
                            Can view payments
                        </label>

                        <label for="editPrivileges">
                            <input type="checkbox" id="editPrivileges" name="editPrivileges">
                            Can edit privileges
                        </label>

                        <label for="editUserGroups">
                            <input type="checkbox" id="editUserGroups" name="editUserGroups">
                            Can edit user groups
                        </label>

                        <label for="editUsers">
                            <input type="checkbox" id="editUsers" name="editUsers">
                            Can edit users
                        </label>

                        <label for="editCompany">
                            <input type="checkbox" id="editCompany" name="editCompany">
                            Can edit the company
                        </label>

                        <?php

                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>