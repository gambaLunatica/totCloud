<?php
$con = mysqli_connect("localhost","root","") or die("Localhost no disponible");
$db = mysqli_select_db($con,"totcloud") or die("Base de dades no disponible");

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

            $username = $user->getUsername();
            $realName = $user->getRealName();
            $realSurname = $user->getRealSurname();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $idUserGroup = $user->getIdUserGroup();
            $idCompany = $user->getIdCompany();

            
            $stmt->bind_param(
                "sssssii",
                $username,
                $realName,
                $realSurname,
                $email,
                $password,
                $idUserGroup,
                $idCompany
            );
            
            $returnValue = $stmt->execute();
            
            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            
            return $returnValue;
        } catch (Exception $e) {
            return false;
        }
        
    }
    
    public function insertCompany(Company $company): bool {
        try {
            $sql = "INSERT INTO Company (nameRegion, nameCompany)
                    VALUES (?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }
            
            $nameRegion = $company->getNameRegion();
            $name = $company->getName();

            $stmt->bind_param(
                "ss",
                $nameRegion,
                $name
            );
            
            $returnValue = $stmt->execute();
            
            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            
            $company->setId($this->db->insert_id);
            
            return $returnValue;
        } catch (Exception $e) {
            return false;
        }
        return false;
    }
    
    public function insertUserGroup(UserGroup $userGroup): bool {
        try {
            $sql = "INSERT INTO UserGroup (idCompany, nameUserGroup)
                    VALUES (?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $idCompany = $userGroup->getIdCompany();
            $name = $userGroup->getName();
            
            $stmt->bind_param(
                "is",
                $idCompany,
                $name
            );
            
            $returnValue = $stmt->execute();
            
            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            
            $userGroup->setId($this->db->insert_id);
            
            return $returnValue;
        } catch (Exception $e) {
            return false;
        }
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

    public function selectUserByUsername(){
        //TODO
    }

    public function selectUserByEmail(string $email):array{
        //TODO
    }

    
}

$dataBase = new MyDataBase($con);
?>