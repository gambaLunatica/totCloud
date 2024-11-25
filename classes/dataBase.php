<?php
$con = mysqli_connect("localhost","root","") or die("Localhost no disponible");
$db = mysqli_select_db($con,"totcloud") or die("Base de dades no disponible");

require "user.php";

class MyDataBase{
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function addUser(User $user):bool{
        
    }
}
?>