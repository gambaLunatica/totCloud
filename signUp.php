<?php
include "head.php";
include "classes/dataBase.php";
?>

<body>
    <?php include "navbar.php" ?>

    <main>
        <div>
            <h1>Hello again!</h1>
            <div class="loginBody">
                <div>
                    <h2>Log in</h2>
                    <form action="classes/loginAction.php" method="post">
                        <label for="email">Email</label>
                        <br>
                        <input type="email" id="email" name="email" required>
                        <br>
                        <label for="password">Password</label>
                        <br>
                        <input type="password" id="password" name="password" required>
                        <br><br>
                        <button class="goButton" type="submit">Go</button>
                    </form>
                </div>

                <div class="vl"></div>

                <div>
                    <h2>... or create a Company</h2>
                    <form action="classes/signupAction.php" method="post">
                        <h3>Company</h3>
                        <label for="companyName">Company Name</label>
                        <input type="text" id="companyName" name="companyName" required>
                        <br>
                        <label for="region">Region</label>
                        <select id="region" name="region" required>
                            <option value="">Select an option</option>
                            <?php
                            $regions = $dataBase->selectRegions(); // Ensure this returns an array
                            foreach ($regions as $region) {
                                echo '<option value="' . htmlspecialchars($region, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($region, ENT_QUOTES, 'UTF-8') . '</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <br>
                        <h3>Master User</h3>
                        <label for="realName">Name</label>
                        <input type="text" id="realName" name="realName" required>
                        <br>
                        <label for="realSurname">Surname</label>
                        <br>
                        <input type="text" id="realSurname" name="realSurname" required>
                        <br><br>
                        <label for="email">Email</label>
                        <br>
                        <input type="email" id="email" name="email" required>
                        <br>
                        <label for="password">Password</label>
                        <br>
                        <input type="password" id="password" name="password" required>
                        <br><br>
                        <button class="goButton" type="submit">Go</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>