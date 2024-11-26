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
            $sql = "INSERT INTO MyUser (realName, realSurname, email, password, idUserGroup, nameCompany)
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $realName = $user->getRealName();
            $realSurname = $user->getRealSurname();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $idUserGroup = $user->getIdUserGroup();
            $idCompany = $user->getNameCompany();

            
            $stmt->bind_param(
                "ssssis",
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
    
    public function insertCompany(Company $company, User $user): int {
        try {
            $sql = "SELECT RegisterCompany(?, ?, ?, ?, ?, ?) AS groupId";
            
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }
            
            $nameRegion = $company->getNameRegion();
            $nameCompany = $company->getName();

            $realName = $user->getRealName();
            $surname = $user->getRealSurname();
            $email = $user->getEmail();
            $password = $user->getPassword();

            $stmt->bind_param(
                'ssssss',
                $nameRegion,
                $nameCompany,
                $realName,
                $surname,
                $email,
                $password
            );
            
            if($stmt->execute())
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    return $row['groupId'];
                }
            }
            
            
            return -1;
        } catch (Exception $e) {
            return -1;
        }
    }
    
    public function insertUserGroup(UserGroup $userGroup): bool {
        try {
            $sql = "INSERT INTO UserGroup (nameCompany, nameUserGroup)
                    VALUES (?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $idCompany = $userGroup->getNameCompany();
            $name = $userGroup->getName();
            
            $stmt->bind_param(
                "ss",
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


    
}

$dataBase = new MyDataBase($con);
?>