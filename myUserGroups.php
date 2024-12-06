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
            <form action="classes/userGroupAction.php" method="post">
                <div style="margin-bottom:10px;">
                    <div style="">
                        <label for="nameUserGroup">Name</label>
                        <input type="text" id="nameUserGroup" name="nameUserGroup" required>
                    </div>
                    <?php if($dataBase->canEditPrivileges()){?>
                    <div>
                        <h3>Management</h3>
                        <div style="display:flex; flex-wrap: wrap;">
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
                            if ($dataBase->isSuperAdmin()) {
                                echo '  <label for="superAdmin">
                                        <input type="checkbox" id="superAdmin" name="superAdmin">
                                            Is Super Admin
                                        </label>';
                            }
                            ?>
                        </div>

                        <h3>Products</h3>
                        <div style="display:flex; flex-wrap: wrap;">
                            <label for="viewDataBases">
                                <input type="checkbox" id="viewDataBases" name="viewDataBases">
                                Can view data bases
                            </label>

                            <label for="viewComputeInstances">
                                <input type="checkbox" id="viewComputeInstances" name="viewComputeInstances">
                                Can view compute instances
                            </label>

                            <label for="viewStorages">
                                <input type="checkbox" id="viewStorages" name="viewStorages">
                                Can view storages
                            </label>

                            <label for="viewVirtualNetworks">
                                <input type="checkbox" id="viewVirtualNetworks" name="viewVirtualNetworks">
                                Can view virtual networks
                            </label>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <button class="goButton" name="action" value="add" type="submit">Add</button>
            </form>
        </div>
    </div>
</div>