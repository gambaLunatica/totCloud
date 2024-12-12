<?php include 'classes/user.php'; ?>
<script src="functions.js"></script>
<div class = "topDesc">
    <div class = "textDesc">
        <h1 style="text-align: center;">¡WELCOME BACK TO TOTCLOUD, 
            <?php 
                $user = unserialize($_SESSION["user"]);
                $username = $user->getRealName();
                echo $username
            ?>
        </h1>
    </div>
    <img src = "totCloud.jpg" alt="Princilpal Image" class="imageDesc">
</div>
<div class = "catalog">
    <div class="product" onclick="navigateTo('Computerpage.php')">
        <img src = "https://media.istockphoto.com/id/162488938/es/foto/c%C3%B3digo-binario-y-monitores-de-ordenadores.jpg?s=612x612&w=0&k=20&c=2KyjtxxbZlTemdm4I2uLSPtKqc5xsuyEPa9vuwQvCH0=" alt="MV">
        <h3>My Virtual Machines</h3>
    </div>
    <div class = "product" onclick="navigateTo('Storagepage.php')" >
        <img src="https://media.istockphoto.com/id/1254718662/es/foto/tecnolog%C3%ADa-de-computaci%C3%B3n-en-la-nube-y-almacenamiento-de-datos-en-l%C3%ADnea-para-el-concepto-de.jpg?s=612x612&w=0&k=20&c=YKkf-ZVfnT0X2w_WXAfri9zKaIC1IRnqUoPHGLoPfDU=" alt="Storage">
        <h3> My Storage Units</h3>
    </div>
    <div class = "product" onclick="navigateTo('DBpage.php')">
        <img src="https://media.istockphoto.com/id/1399944678/es/foto/se-coloca-varias-bases-de-datos-en-tablas-de-bases-de-datos-relacionales-con-sala-de.jpg?s=612x612&w=0&k=20&c=-WzVYH2l8haNOOXD5ErkD2UFScCdjUCNDKO72HTP3DQ=" alt="dataBases">
        <h3>My Databases</h3>
    </div>
    <div class = "product" onclick="navigateTo('VCNpage.php')">
        <img src = "virtualNetworks.jpg" alt="virtualNetwork">
        <h3>My Virtual Network</h3>
    </div>
</div>