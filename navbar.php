<div class="topnav">
    <ul>
        <li><a class="navbutton" href="index.php"><i class="fa-solid fa-house"></i></a></li>
        <li><a class="navbutton" href="#">Virtual Machines</a></li>
        <li><a class="navbutton" href="#">Storages</a></li>
        <li><a class="navbutton" href="#">Data Bases</a></li>
        <li><a class="navbutton" href="#">Virtual Networks</a></li>
    </ul>


    <?php if (isset($_SESSION["user"])): ?>
        
            <a href="#" class="navbutton navuser">
                <i class="fa-solid fa-user"></i>
                <div>My Account</div>
            </a>
        
    <?php else: ?>
        
            <a href="signUp.php" class="navbutton navuser">
                <i class="fa-solid fa-right-to-bracket"></i>
                <div>Log In</div>
            </a>
        
    <?php endif; ?>

</div>