<?php
$con = mysqli_connect("localhost", "root", "") or die("Localhost no disponible");
$db = mysqli_select_db($con, "totcloud") or die("Base de dades no disponible");

if (!isset($_SESSION)) {
    session_start();
}

class MyDataBase
{
    private $db;
    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function insertUser(User $user): bool
    {
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

    public function insertCompany(Company $company, User $user): int
    {
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
                $nameCompany,
                $nameRegion,
                $realName,
                $surname,
                $email,
                $password
            );

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    return $row['groupId'];
                }
            }


            return -3;
        } catch (Exception $e) {
            return -2;
        }
    }

    public function insertUserGroup(UserGroup $userGroup): bool
    {
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

    public function selectRegions(): array
    {
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

    public function getUser(User $user): User|null
    {
        try {

            $email = $user->getEmail();
            $password = $user->getPassword();
            $stmt = $this->db->prepare("SELECT realName, realSurname, email, password, idUserGroup, nameCompany FROM MyUser WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    $user->setRealName($row["realName"]);
                    $user->setRealSurname($row["realSurname"]);
                    $user->setIdUserGroup($row["idUserGroup"]);
                    $user->setNameCompany($row["nameCompany"]);
                    return $user;
                }
            }


            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function insertPrivileges(int $idUserGroup, bool $value)
    {
        $sql = "CALL InsertPrivilegeStatus(?, ?)";
        if ($value) {
            $value = 1;
        } else {
            $value = 0;
        }

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("is", $idUserGroup, $value);
            $stmt->execute();
        }
    }

    public function getPrivilegesByUserGroupId(int $userGroupId):array|null
    {
        $query = "SELECT namePrivilege FROM PrivilegeStatus WHERE idUserGroup = ? AND value = 1";

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param("i", $userGroupId);
            $stmt->execute();

            // Bind the result
            $stmt->bind_result($namePrivilege);

            // Fetch the results into an array
            $privileges = [];
            while ($stmt->fetch()) {
                $privileges[] = $namePrivilege;
            }

            if(!empty($privileges)) {
                return $privileges;
            }
            return null;
        }
        return null;
    }
}

$dataBase = new MyDataBase($con);
?>