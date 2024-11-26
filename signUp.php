<?php
include "head.php";
include "classes/dataBase.php";
?>

<body>
    <?php include "navbar.php" ?>

    <main>
        <div style="padding: 0% 20%;">
            <h1>Hello again!</h1>
            <div class="loginBody">
                <div>
                    <h2>Log In</h2>
                    <form action="" method="post">
                        <label for="username">Username</label>
                        <br>
                        <input type="text" id="username" name="username" required>
                        <br><br>
                        <label for="password">Password</label>
                        <br>
                        <input type="password" id="password" name="password" required>
                        <br><br>
                        <button type="submit">Go</button>
                    </form>
                </div>

                <div class="vl"></div>

                <div>
                    <h2>... or create a Company</h2>
                    <form action="" method="post">
                        <h3>Company</h3>
                        <br>
                        <label for="companyName">Company Name</label>
                        <input type="text" id="companyName" name="companyName" required>

                        <select name="dropdown" required>
                            <option value="">Select an option</option>
                            <?php
                            $regions = $dataBase->selectRegions(); // Ensure this returns an array
                            foreach ($regions as $region) {
                                echo '<option value="' . htmlspecialchars($region, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($region, ENT_QUOTES, 'UTF-8') . '</option>';
                            }
                            ?>
                        </select>

                        <br>
                        <h3>Master User</h3>
                        <br>
                        <br><br>
                        <label for="password">Password</label>
                        <br>
                        <input type="password" id="password" name="password" required>
                        <br><br>
                        <button type="submit">Go</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>