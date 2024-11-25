<?php
$con = mysqli_connect("localhost","root","") or die("Localhost no disponible");
$db = mysqli_select_db($con,"totcloud") or die("Base de dades no disponible");

require "user.php";

class MyDataBase{
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function insertUser(User $user):bool{
        try {
            $sql = "INSERT INTO MyUser (userName, realName, realSurname, email, password, idUserGroup, idCompany)
                    VALUES (:userName, :realName, :realSurname, :email, :password, :idUserGroup, :idCompany)";
            
            $stmt = $this->db->prepare($sql);
            
            // Bind parameters from the User object
            $stmt->bindValue(':userName', $user->getName());
            $stmt->bindValue(':realName', $user->getName()); // Adjust for actual real name logic
            $stmt->bindValue(':realSurname', $user->getName()); // Adjust for actual real surname logic
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':idUserGroup', $user->getUserGroup(), PDO::PARAM_INT);
            $stmt->bindValue(':idCompany', $user->getIdCompany(), PDO::PARAM_INT);
    
            // Execute the statement
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error adding user: " . $e->getMessage();
        }
        return false;
    }

    
}
?>