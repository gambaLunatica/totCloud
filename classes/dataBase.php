<?php
$con = mysqli_connect("localhost","root","") or die("Localhost no disponible");
$db = mysqli_select_db($con,"totcloud") or die("Base de dades no disponible");

require "user.php";

class MyDataBase{
    private $db;
    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function insertUser(User $user): bool {
        try {
            $sql = "INSERT INTO MyUser (userName, realName, realSurname, email, password, idUserGroup, idCompany)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }
            
            $stmt->bind_param(
                "sssssii",
                $user->getName(),
                $user->getRealName(),
                $user->getRealSurname(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getIdUserGroup(),
                $user->getIdCompany()
            );
            
            $returnValue = $stmt->execute();
            
            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            
            return $returnValue;
        } catch (Exception $e) {
            echo "Error adding user: " . $e->getMessage();
        }
        return false;
    }
    
    public function insertCompany(Company $company): bool {
        try {
            $sql = "INSERT INTO Company (nameRegion, nameCompany)
                    VALUES (?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }
            
            $stmt->bind_param(
                "ss",
                $company->getNameRegion(),
                $company->getName()
            );
            
            $returnValue = $stmt->execute();
            
            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            
            $company->setId($this->db->insert_id);
            
            return $returnValue;
        } catch (Exception $e) {
            echo "Error adding company: " . $e->getMessage();
        }
        return false;
    }
    
    public function insertUserGroup(UserGroup $userGroup): bool {
        try {
            $sql = "INSERT INTO UserGroup (idCompany, creationDate, nameUserGroup)
                    VALUES (?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }
            
            $stmt->bind_param(
                "iss",
                $userGroup->getIdCompany(),
                $userGroup->getCreationDate()->format(format: 'Y-m-d H:i:s'),
                $userGroup->getName()
            );
            
            $returnValue = $stmt->execute();
            
            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            
            $userGroup->setId($this->db->insert_id);
            
            return $returnValue;
        } catch (Exception $e) {
            echo "Error adding UserGroup: " . $e->getMessage();
        }
        return false;
    }
    
    public function selectRegions():array{
        $sql = "SELECT nameRegion FROM Region";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["nameRegion"]); // Sanitize the value
            }
        }
        return $values;
    }
    
}

$dataBase = new MyDataBase($con);
?>