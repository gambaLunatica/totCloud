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

    //SERIES
    public function insertSeries(String $series): bool{
        try {
            $sql = "INSERT INTO Series (series) VALUES (?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $series
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

    public function selectSeries(): array
    {
        $sql = "SELECT series FROM Series";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["series"]);
            }
        }
        return $values;
    }

    public function deleteSeries(String $series): bool{
        try {
            $sql = "DELETE FROM Series WHERE series = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $series
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

    //GENERATION
    public function insertGeneration(String $generation): bool{
        try {
            $sql = "INSERT INTO Generation (generation) VALUES (?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $generation
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

    public function selectGenerations(): array
    {
        $sql = "SELECT generation FROM Generation";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["generation"]);
            }
        }
        return $values;
    }

    public function deleteGeneration(String $generation): bool{
        try {
            $sql = "DELETE FROM Generation WHERE series = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $generation
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

    //SPEED
    public function insertSpeed(float $speed): bool{
        try {
            $sql = "INSERT INTO Speed (IOSpeed) VALUES (?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "d",
                $speed
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

    public function selectSpeeds(): array
    {
        $sql = "SELECT IOSpeed FROM Speed";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["IOSpeed"]);
            }
        }
        return $values;
    }

    public function deleteSpeed(float $speed): bool{
        try {
            $sql = "DELETE FROM Speed WHERE IOSpeed = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "d",
                $speed
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

    //SIZE
    public function insertSize(float $size): bool{
        try {
            $sql = "INSERT INTO Speed (IOSpeed) VALUES (?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "d",
                $size
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

    public function selectSizes(): array
    {
        $sql = "SELECT totalCapacity FROM Size";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["totalCapacity"]);
            }
        }
        return $values;
    }

    public function deleteSize(float $size): bool{
        try {
            $sql = "DELETE FROM Size WHERE totalCapacity = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "d",
                $size
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

    //OS
    public function insertOS(String $os): bool{
        try {
            $sql = "INSERT INTO OS (osName) VALUES (?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $os
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

    public function selectOS(): array
    {
        $sql = "SELECT osName FROM OS";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["osName"]);
            }
        }
        return $values;
    }

    public function deleteOS(String $os): bool{
        try {
            $sql = "DELETE FROM OS WHERE osName = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $os
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

    //LOGIN, USER, COMPANY, USERGROUPS
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

    public function insertUserGroup(UserGroup $userGroup): bool{
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

    public function selectRegions(): array
    {
        $sql = "SELECT nameRegion FROM Region";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["nameRegion"]);
            }
        }
        return $values;
    }

    //Status
    public function selectStatus(): array
    {
        $sql = "SELECT statusName FROM Status";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["statusName"]);
            }
        }
        return $values;
    }

    //IMAGE
    public function selectImages(String $status=null): array{
        if($status==null){
            $sql = "SELECT idImage, statusName, cost, osName, build FROM Image";
        } else{
            $sql = "SELECT idImage, statusName, cost, osName, build FROM Image WHERE statusName = $status";
        }
        
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = new Image($row["idImage"], $row["statusName"], $row["cost"], $row["osName"], $row["build"]);
            }
        }
        return $values;
    }

    public function selectImage(int $id): Image|null{
        
        $sql = "SELECT idImage, statusName, cost, osName, build FROM Image WHERE idImage = $id";
        
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new Image($row["idImage"], $row["statusName"], $row["cost"], $row["osName"], $row["build"]);
            }
        }
        return null;
    }

    public function insertImage(Image $image): bool{
        try {
            $sql = "INSERT INTO Image (statusName, cost, osName, build)
                    VALUES (?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $image->getStatusName();
            $cost = $image->getCost();
            $osName = $image->getOsName();
            $build = $image->getBuild();

            $stmt->bind_param(
                "sdss",
                $statusName,
                $cost,
                    $osName,
                    $build,
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

    public function updateImage(Image $image): bool{
        try {
            $sql = "UPDATE Image SET 
                statusName = ?, 
                cost = ?, 
                osName = ?, 
                build = ?
                WHERE idImage = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $image->getStatusName();
            $cost = $image->getCost();
            $osName = $image->getOsName();
            $build = $image->getBuild();
            $idImage = $image->getIdImage();


            $stmt->bind_param(
                "sdssi",
                $statusName,
                $cost,
                    $osName,
                    $build,
                    $idImage
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
    public function deleteImage(Image $image): bool{
        try {
            $sql = "DELETE FROM Image WHERE idImage = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $idImage = $image->getIdImage();

            $stmt->bind_param(
                "i",
                $idImage
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

    public function insertImageCompatibility($model, $image):void{

    }

    public function selectCPUs(String $status=null):array{

        if($status==null){
            $sql = "SELECT model FROM CPU";
        } else{
            $sql = "SELECT model FROM CPU WHERE statusName = $status";
        }
        
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["model"]);
            }
        }
        return $values;
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