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
    public function insertSeries(string $series): bool
    {
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

    public function deleteSeries(string $series): bool
    {
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
    public function insertGeneration(string $generation): bool
    {
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

    public function deleteGeneration(string $generation): bool
    {
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
    public function insertSpeed(float $speed): bool
    {
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

    public function deleteSpeed(float $speed): bool
    {
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
    public function insertSize(float $size): bool
    {
        try {
            $sql = "INSERT INTO Size (totalCapacity) VALUES (?)";

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

    public function deleteSize(float $size): bool
    {
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
    public function insertOS(string $os): bool
    {
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

    public function deleteOS(string $os): bool
    {
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

    //COMPANY
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

    function updateCompany(Company $company): bool
    {
        $query = "UPDATE Company SET nameRegion = ? WHERE nameCompany = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            return false; // Handle error if statement preparation fails
        }

        $nameRegion = $company->getNameRegion();
        $name = $company->getName();

        $stmt->bind_param("ss", $nameRegion, $name);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function selectCompany(string $name): ?Company
    {
        $query = "SELECT nameCompany, nameRegion FROM Company WHERE nameCompany = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            return null; // Handle error if statement preparation fails
        }

        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->bind_result($fetchedName, $fetchedRegion);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Company($fetchedName, $fetchedRegion);
        }

        $stmt->close();
        return null; // Return null if no company is found
    }

    //USER GROUP
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

    public function selectUserGroups(): array
    {
        $query = "SELECT * FROM UserGroup";
        $result = $this->db->query($query);

        $userGroups = [];
        while ($row = $result->fetch_assoc()) {
            $userGroup = new UserGroup($row['nameCompany'], $row['nameUserGroup']);
            $userGroup->setId($row['idUserGroup']);
            $userGroup->setCreationDate(new DateTime($row['creationDate']));
            $userGroups[] = $userGroup;
        }

        return $userGroups;
    }

    public function selectUserGroup(int $id): ?UserGroup
    {
        $query = "SELECT * FROM UserGroup WHERE idUserGroup = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $userGroup = new UserGroup($row['nameCompany'], $row['nameUserGroup']);
            $userGroup->setId($row['idUserGroup']);
            $userGroup->setCreationDate(new DateTime($row['creationDate']));
            return $userGroup;
        }
        return null;
    }

    public function updateUserGroup(UserGroup $userGroup): bool
    {
        $query = "UPDATE UserGroup SET nameCompany = ?, nameUserGroup = ? WHERE idUserGroup = ?";
        $stmt = $this->db->prepare($query);

        $companyName = $userGroup->getNameCompany();
        $userGroupName = $userGroup->getName();
        $userGroupId = $userGroup->getId();


        $stmt->bind_param(
            'ssi',
            $companyName,
            $userGroupName,
            $userGroupId
        );
        return $stmt->execute();
    }

    public function deleteUserGroup(int $id): bool
    {
        $query = "DELETE FROM UserGroup WHERE idUserGroup = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
    //USER
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

    public function selectUser(User $user): User|null
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

    public function updateUser(User $user): bool
    {
        $query = "UPDATE MyUser 
                  SET realName = ?, realSurname = ?, password = ?, idUserGroup = ?, nameCompany = ? 
                  WHERE email = ?";

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }

        $realName = $user->getRealName();
        $realSurname = $user->getRealSurname();
        $password = $user->getPassword();
        $idUserGroup = $user->getIdUserGroup();
        $nameCompany = $user->getNameCompany();
        $email = $user->getEmail();

        $stmt->bind_param("sssiss", $realName, $realSurname, $password, $idUserGroup, $nameCompany, $email);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return $affectedRows > 0;
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
    public function selectImages(string $status = null): array
    {
        if ($status == null) {
            $sql = "SELECT idImage, statusName, cost, osName, build FROM Image";
        } else {
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

    public function selectImage(int $id): Image|null
    {

        $sql = "SELECT idImage, statusName, cost, osName, build FROM Image WHERE idImage = $id";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new Image($row["idImage"], $row["statusName"], $row["cost"], $row["osName"], $row["build"]);
            }
        }
        return null;
    }

    public function insertImage(Image $image): bool
    {
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

    public function updateImage(Image $image): bool
    {
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
    public function deleteImage(Image $image): bool
    {
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

    //MEMORY
    public function selectMemories(string $status = null): array
    {
        if ($status == null) {
            $sql = "SELECT idMemory, statusName, totalCapacity, IOSpeed, generation, cost FROM Memory";
        } else {
            $sql = "SELECT idMemory, statusName, totalCapacity, IOSpeed, generation, cost FROM Memory WHERE statusName = $status";
        }

        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = new Memory($row["idMemory"], $row["statusName"], $row["totalCapacity"], $row["IOSpeed"], $row["generation"], $row["cost"]);
            }
        }
        return $values;
    }

    public function selectMemory(int $id): Memory|null
    {

        $sql = "SELECT idMemory, statusName, totalCapacity, IOSpeed, generation, cost FROM Memory WHERE idMemory = $id";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new Memory($row["idMemory"], $row["statusName"], $row["totalCapacity"], $row["IOSpeed"], $row["generation"], $row["cost"]);
            }
        }
        return null;
    }

    public function insertMemory(Memory $memory): bool
    {
        try {
            $sql = "INSERT INTO Memory (statusName, totalCapacity, IOSpeed, generation, cost)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $memory->getStatusName();
            $totalCapacity = $memory->getTotalCapacity();
            $IOSpeed = $memory->getIOSpeed();
            $generation = $memory->getGeneration();
            $cost = $memory->getCost();

            $stmt->bind_param(
                "sddsd",
                $statusName,
                $totalCapacity,
                $IOSpeed,
                $generation,
                $cost
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

    public function updateMemory(Memory $memory): bool
    {
        try {
            $sql = "UPDATE Memory SET 
                statusName = ?, 
                totalCapacity = ?, 
                IOSpeed = ?, 
                generation = ?,
                cost = ?
                WHERE idMemory = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $memory->getStatusName();
            $totalCapacity = $memory->getTotalCapacity();
            $IOSpeed = $memory->getIOSpeed();
            $generation = $memory->getGeneration();
            $cost = $memory->getCost();
            $idMemory = $memory->getIdMemory();


            $stmt->bind_param(
                "sddsdi",
                $statusName,
                $totalCapacity,
                $IOSpeed,
                $generation,
                $cost,
                $idMemory
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
    public function deleteMemory(Memory $memory): bool
    {
        try {
            $sql = "DELETE FROM Memory WHERE idMemory = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $idMemory = $memory->getIdMemory();

            $stmt->bind_param(
                "i",
                $idMemory
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

    //CPU
    public function selectCPUs(string $status = null): array
    {

        if ($status == null) {
            $sql = "SELECT model FROM CPU";
        } else {
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

    public function selectCPU(string $model): CPU|null
    {

        $sql = "SELECT statusName,coreCount,cacheL1,cacheL2,cacheL3,frequency,cost,model,series FROM CPU WHERE model = '$model'";
        $result = $this->db->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cpu = new CPU($row["model"], $row["series"], $row["statusName"], $row["coreCount"], $row["cacheL1"], $row["cacheL2"], $row["cacheL3"], $row["frequency"], $row["cost"]);

            $sql = "SELECT idMemory FROM CompatibilityMemoryCPU WHERE model = '$model'";
            $result = $this->db->query($sql);

            $memories = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $memories[] = $row["idMemory"];
                }
            }

            $sql = "SELECT idImage FROM CompatibilityCPUImage WHERE model = '$model'";
            $result = $this->db->query($sql);

            $images = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $images[] = $row["idImage"];
                }
            }

            $cpu->setMemories($memories);
            $cpu->setImages($images);

            return $cpu;
        }
        return null;
    }

    public function updateCPU(CPU $cpu): bool
    {
        try {

            //UPDATE CPU
            $sql = "UPDATE CPU SET 
                statusName = ?,
                coreCount = ?,
                cacheL1 = ?,
                cacheL2 = ?,
                cacheL3 = ?,
                frequency = ?,
                cost = ?,
                model = ?,
                series = ?
                WHERE model = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $cpu->getStatusName();
            $coreCount = $cpu->getCoreCount();
            $cacheL1 = $cpu->getCacheL1();
            $cacheL2 = $cpu->getCacheL2();
            $cacheL3 = $cpu->getCacheL3();
            $frequency = $cpu->getFrequency();
            $cost = $cpu->getCost();
            $model = $cpu->getModel();
            $series = $cpu->getSeries();


            $stmt->bind_param(
                "sidddddsss",
                $statusName,
                $coreCount,
                $cacheL1,
                $cacheL2,
                $cacheL3,
                $frequency,
                $cost,
                $model,
                $series,
                $model
            );

            $returnValue = $stmt->execute();

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            //CLEAR IMAGES
            $sql = "DELETE FROM CompatibilityCPUImage WHERE model = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $stmt->bind_param(
                "s",
                $model
            );

            $returnValue = $stmt->execute();

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            //ADD IMAGES
            $images = $cpu->getImages();

            $stmt = $this->db->prepare("INSERT INTO CompatibilityCPUImage (model, idImage) VALUES (?, ?)");

            // Check if preparation is successful
            if (!$stmt) {
                die("Preparation failed: " . $this->db->error);
            }

            // Bind parameters
            $stmt->bind_param("si", $model, $image);

            // Loop through the array and execute the statement for each idImage
            foreach ($images as $image) {
                if (!$stmt->execute()) {
                    $returnValue = false;
                }
            }

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            //CLEAR MEMORIES
            $sql = "DELETE FROM CompatibilityMemoryCPU WHERE model = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $stmt->bind_param(
                "s",
                $model
            );

            $returnValue = $stmt->execute();

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            //ADD MEMORIES
            $memories = $cpu->getMemories();

            $stmt = $this->db->prepare("INSERT INTO CompatibilityMemoryCPU (model, idMemory) VALUES (?, ?)");

            // Check if preparation is successful
            if (!$stmt) {
                die("Preparation failed: " . $this->db->error);
            }

            // Bind parameters
            $stmt->bind_param("si", $model, $memory);

            foreach ($memories as $memory) {
                if (!$stmt->execute()) {
                    $returnValue = false;
                }
            }

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }


            return $returnValue;
        } catch (Exception $e) {
            return false;
        }
    }
    public function deleteCPU(string $model): bool
    {
        try {
            //CLEAR MEMORIES
            $sql = "DELETE FROM CompatibilityMemoryCPU WHERE model = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $stmt->bind_param(
                "s",
                $model
            );

            $returnValue = $stmt->execute();

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            //DELETE IMAGES
            $sql = "DELETE FROM CompatibilityCPUImage WHERE model = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $stmt->bind_param(
                "s",
                $model
            );

            $returnValue = $stmt->execute();

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            //DELETE CPU
            $sql = "DELETE FROM CPU WHERE model = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $model
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

    public function insertCPU(CPU $cpu): bool
    {
        try {
            $sql = "INSERT INTO CPU (statusName,coreCount,cacheL1,cacheL2,cacheL3,frequency,cost,model,series)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $cpu->getStatusName();
            $coreCount = $cpu->getCoreCount();
            $cacheL1 = $cpu->getCacheL1();
            $cacheL2 = $cpu->getCacheL2();
            $cacheL3 = $cpu->getCacheL3();
            $frequency = $cpu->getFrequency();
            $cost = $cpu->getCost();
            $model = $cpu->getModel();
            $series = $cpu->getSeries();


            $stmt->bind_param(
                "sidddddss",
                $statusName,
                $coreCount,
                $cacheL1,
                $cacheL2,
                $cacheL3,
                $frequency,
                $cost,
                $model,
                $series
            );

            $returnValue = $stmt->execute();

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            $images = $cpu->getImages();

            $stmt = $this->db->prepare("INSERT INTO CompatibilityCPUImage (model, idImage) VALUES (?, ?)");

            // Check if preparation is successful
            if (!$stmt) {
                die("Preparation failed: " . $this->db->error);
            }

            // Bind parameters
            $stmt->bind_param("si", $model, $image);

            // Loop through the array and execute the statement for each idImage
            foreach ($images as $image) {
                if (!$stmt->execute()) {
                    $returnValue = false;
                }
            }

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            $memories = $cpu->getMemories();

            $stmt = $this->db->prepare("INSERT INTO CompatibilityMemoryCPU (model, idMemory) VALUES (?, ?)");

            // Check if preparation is successful
            if (!$stmt) {
                die("Preparation failed: " . $this->db->error);
            }

            // Bind parameters
            $stmt->bind_param("si", $model, $memory);

            foreach ($memories as $memory) {
                if (!$stmt->execute()) {
                    $returnValue = false;
                }
            }

            if (!$returnValue) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }


            return $returnValue;
        } catch (Exception $e) {
            return false;
        }
    }

    public function selectImageCompatibility(string $model): array
    {

        $sql = "SELECT idImage FROM compatibilitycpuimage WHERE model = '$model'";

        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["idImage"]);
            }
        }
        return $values;
    }

    public function selectMemoryCompatibility(string $model): array
    {

        $sql = "SELECT idMemory FROM compatibilitymemorycpu WHERE model = '$model'";

        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["idMemory"]);
            }
        }
        return $values;
    }

    //PRIVILEGES

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

    public function getPrivilegesByUserGroupId(int $userGroupId): array|null
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

            if (!empty($privileges)) {
                return $privileges;
            }
            return null;
        }
        return null;
    }

    //REGION
    public function insertRegion(string $nameRegion): bool
    {
        try {
            $sql = "INSERT INTO region (nameRegion) VALUES (?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $nameRegion
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

    public function deleteRegion(string $nameRegion): bool
    {
        try {
            $sql = "DELETE FROM region WHERE nameRegion = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $nameRegion
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

    public function selectRegion(): array
    {
        $sql = "SELECT regionName FROM Region";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["regionName"]);
            }
        }
        return $values;
    }

    //MASK
    public function selectMasks(): array
    {
        $sql = "SELECT cidr, cost FROM Mask";

        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = new Mask($row["cost"], $row["cidr"]);
            }
        }
        return $values;
    }

    public function selectMask(int $cidr): Mask|null
    {

        $sql = "SELECT cidr, cost FROM Mask WHERE cidr = $cidr";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new Mask($row["cost"], $row["cidr"]);
            }
        }
        return null;
    }

    public function insertMask(Mask $mask): bool
    {
        try {
            $sql = "INSERT INTO Mask (cidr, cost)
                    VALUES (?, ?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $cdir = $mask->getCidr();
            $cost = $mask->getCost();


            $stmt->bind_param(
                "id",
                $cdir,
                $cost
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

    public function updateMask(Mask $mask): bool
    {
        try {
            $sql = "UPDATE Mask SET 
                cidr = ?, 
                cost = ?, 
                WHERE cidr = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $cidr = $mask->getCidr();
            $cost = $mask->getCost();

            $stmt->bind_param(
                "id",
                $cidr,
                $cost,
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
    public function deleteMask(int $cidr): bool
    {
        try {
            $sql = "DELETE FROM Mask WHERE cidr = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $stmt->bind_param(
                "i",
                $cidr
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

    //STORAGE TYPE
    public function insertType(string $type): bool
    {
        try {
            $sql = "INSERT INTO Type (typeName) VALUES (?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $type
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

    public function selectTypes(): array
    {
        $sql = "SELECT typeName FROM type";
        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = htmlspecialchars($row["typeName"]);
            }
        }
        return $values;
    }

    public function deleteType(string $type): bool
    {
        try {
            $sql = "DELETE FROM Type WHERE typeName = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }


            $stmt->bind_param(
                "s",
                $type
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

    //STORAGE
    public function selectStorages(string $status = null): array
    {
        if ($status == null) {
            $sql = "SELECT totalCapacity,IOSpeed,typeName,nameStorage,cost, statusName FROM Storage";
        } else {
            $sql = "SELECT totalCapacity,IOSpeed,typeName,nameStorage,cost, statusName FROM Storage WHERE statusName = $status";
        }

        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = new Storage($row["totalCapacity"], $row["IOSpeed"], $row["typeName"], $row["nameStorage"], $row["cost"], $row["statusName"]);
            }
        }
        return $values;
    }

    public function selectStorage(string $nameStorage): Storage|null
    {

        $sql = "SELECT totalCapacity,IOSpeed,typeName,nameStorage,cost, statusName FROM Storage WHERE nameStorage = '$nameStorage'";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new Storage(
                    $row["totalCapacity"],
                    $row["IOSpeed"],
                    $row["typeName"],
                    $row["nameStorage"],
                    $row["cost"],
                    $row["statusName"]
                );
            }
        }
        return null;
    }

    public function insertStorage(Storage $storage): bool
    {
        try {
            $sql = "INSERT INTO Storage (totalCapacity,IOSpeed,typeName,nameStorage,cost,statusName)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $totalCapacity = $storage->getTotalCapacity();
            $IOSpeed = $storage->getIOSpeed();
            $typeName = $storage->getTypeName();
            $nameStorage = $storage->getNameStorage();
            $cost = $storage->getCost();
            $statusName = $storage->getStatusName();

            $stmt->bind_param(
                "ddssds",
                $totalCapacity,
                $IOSpeed,
                $typeName,
                $nameStorage,
                $cost,
                $statusName
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

    public function updateStorage(Storage $storage): bool
    {
        try {
            $sql = "UPDATE Storage SET 
                totalCapacity=?,
                IOSpeed=?,
                typeName=?,
                cost=?,
                statusName=?
                WHERE nameStorage=?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $totalCapacity = $storage->getTotalCapacity();
            $IOSpeed = $storage->getIOSpeed();
            $typeName = $storage->getTypeName();
            $cost = $storage->getCost();
            $statusName = $storage->getStatusName();
            $nameStorage = $storage->getNameStorage();


            $stmt->bind_param(
                "ddsdss",
                $totalCapacity,
                $IOSpeed,
                $typeName,
                $cost,
                $statusName,
                $nameStorage
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
    public function deleteStorage(string $nameStorage): bool
    {
        try {
            $sql = "DELETE FROM Storage WHERE nameStorage = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $stmt->bind_param(
                "s",
                $nameStorage
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

    //MySQL
    public function selectMySQLs(string $status = null): array
    {
        if ($status == null) {
            $sql = "SELECT idDBType,statusName,cost,releaseDate,version FROM DBTypeMySql";
        } else {
            $sql = "SELECT idDBType,statusName,cost,releaseDate,version FROM DBTypeMySql WHERE statusName = $status";
        }

        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = new MySQL($row["idDBType"], $row["statusName"], $row["cost"], new DateTime($row["releaseDate"]), $row["version"]);
            }
        }
        return $values;
    }

    public function selectMySQL(int $idDBType): MySQL|null
    {

        $sql = "SELECT idDBType,statusName,cost,releaseDate,version FROM DBTypeMySql WHERE idDBType = $idDBType";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new MySQL($row["idDBType"], $row["statusName"], $row["cost"], new DateTime($row["releaseDate"]), $row["version"]);
            }
        }
        return null;
    }

    public function insertMySQL(MySQL $mySQL): bool
    {
        try {
            $sql = "INSERT INTO DBTypeMySql (statusName,cost,releaseDate,version)
                    VALUES (?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $mySQL->getStatusName();
            $cost = $mySQL->getCost();
            $releaseDate = $mySQL->getReleaseDate()->format('Y-m-d');
            $version = $mySQL->getVersion();

            $stmt->bind_param(
                "sdss",
                $statusName,
                $cost,
                $releaseDate,
                $version
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

    public function updateMySQL(MySQL $mySQL): bool
    {
        try {
            $sql = "UPDATE DBTypeMySql SET 
                statusName=?,
                cost=?,
                releaseDate=?,
                version=?
                WHERE idDBType=?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $mySQL->getStatusName();
            $cost = $mySQL->getCost();
            $releaseDate = $mySQL->getReleaseDate()->format('Y-m-d');
            $version = $mySQL->getVersion();
            $idDBType = $mySQL->getIdDBType();


            $stmt->bind_param(
                "sdssi",
                $statusName,
                $cost,
                $releaseDate,
                $version,
                $idDBType
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
    public function deleteMySQL(int $idDBType): bool
    {
        try {
            $sql = "DELETE FROM DBTypeMySql WHERE idDBType = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $stmt->bind_param(
                "i",
                $idDBType
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

    //POSTGRADE
    public function selectPostgrades(string $status = null): array
    {
        if ($status == null) {
            $sql = "SELECT idDBType,statusName,cost,releaseDate,build FROM DBTypePostgrade";
        } else {
            $sql = "SELECT idDBType,statusName,cost,releaseDate,build FROM DBTypePostgrade WHERE statusName = $status";
        }

        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = new Postgrade($row["idDBType"], $row["statusName"], $row["cost"], new DateTime($row["releaseDate"]), $row["build"]);
            }
        }
        return $values;
    }

    public function selectPostgrade(int $idDBType): Postgrade|null
    {

        $sql = "SELECT idDBType,statusName,cost,releaseDate,build FROM DBTypePostgrade WHERE idDBType = $idDBType";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new Postgrade($row["idDBType"], $row["statusName"], $row["cost"], new DateTime($row["releaseDate"]), $row["build"]);
            }
        }
        return null;
    }

    public function insertPostgrade(Postgrade $postgrade): bool
    {
        try {
            $sql = "INSERT INTO DBTypePostgrade (statusName,cost,releaseDate,build)
                    VALUES (?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $postgrade->getStatusName();
            $cost = $postgrade->getCost();
            $releaseDate = $postgrade->getReleaseDate()->format('Y-m-d');
            $build = $postgrade->getBuild();

            $stmt->bind_param(
                "sdss",
                $statusName,
                $cost,
                $releaseDate,
                $build
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

    public function updatePostgrade(Postgrade $postgrade): bool
    {
        try {
            $sql = "UPDATE DBTypePostgrade SET 
                statusName=?,
                cost=?,
                releaseDate=?,
                build=?
                WHERE idDBType=?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $postgrade->getStatusName();
            $cost = $postgrade->getCost();
            $releaseDate = $postgrade->getReleaseDate()->format('Y-m-d');
            $build = $postgrade->getBuild();
            $idDBType = $postgrade->getIdDBType();


            $stmt->bind_param(
                "sdssi",
                $statusName,
                $cost,
                $releaseDate,
                $build,
                $idDBType
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
    public function deletePostgrade(int $idDBType): bool
    {
        try {
            $sql = "DELETE FROM DBTypePostgrade WHERE idDBType = ?";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $stmt->bind_param(
                "i",
                $idDBType
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

    //SETTING
    function insertSetting(Setting $setting): bool
    {
        // Prepare the SQL statement for calling the stored procedure
        $stmt = $this->db->prepare("CALL AddSetting(?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception("Prepare failed: (" . $this->db->errno . ") " . $this->db->error);
        }

        // Get the values from the Setting object
        $nameSetting = $setting->getNameSetting();
        $statusName = $setting->getStatusName();
        $idDBTypePostgrade = $setting->getIdDBTypePostgrade();
        $idDBTypeMySQL = $setting->getIdDBTypeMySQL();
        $booleanValue = $setting->getBooleanValue();
        $decimalValue = $setting->getDecimalValue();
        $stringValue = $setting->getStringValue();

        // Bind the parameters
        $stmt->bind_param(
            'ssiidds',
            $nameSetting,
            $statusName,
            $idDBTypePostgrade,
            $idDBTypeMySQL,
            $booleanValue,
            $decimalValue,
            $stringValue
        );

        // Execute the statement
        return $stmt->execute();

    }


    function deleteSetting(string $nameSetting): bool
    {
        // Prepare the SQL statement for calling the stored procedure
        $stmt = $this->db->prepare("CALL DeleteSetting(?)");

        if (!$stmt) {
            throw new Exception("Prepare failed: (" . $this->db->errno . ") " . $this->db->error);
        }

        // Bind the parameter
        $stmt->bind_param('s', $nameSetting);

        // Execute the statement
        return $stmt->execute();
    }


    function selectSettings(): array
    {
        // Prepare the SQL query
        $sql = "SELECT 
                nameSetting, 
                statusName, 
                idDBTypeMySQL, 
                idDBTypePostgrade, 
                booleanValue, 
                decimalValue, 
                stringValue 
            FROM Setting";

        // Execute the query
        if (!$result = $this->db->query($sql)) {
            throw new Exception("Query failed: (" . $this->db->errno . ") " . $this->db->error);
        }

        $settings = [];

        // Fetch the results
        while ($row = $result->fetch_assoc()) {
            // Create a Setting object for each row
            $setting = new Setting(
                $row['nameSetting'],
                $row['statusName'],
                (int) $row['idDBTypeMySQL'],
                (int) $row['idDBTypePostgrade'],
                (bool) $row['booleanValue'],
                (float) $row['decimalValue'],
                $row['stringValue']
            );

            $settings[] = $setting;
        }

        // Free the result set
        $result->free();

        return $settings;
    }

    function selectSetting(string $nameSetting): Setting
    {
        // Prepare the SQL statement with a placeholder for nameSetting
        $stmt = $this->db->prepare("SELECT 
                                nameSetting, 
                                statusName, 
                                idDBTypeMySQL, 
                                idDBTypePostgrade, 
                                booleanValue, 
                                decimalValue, 
                                stringValue 
                            FROM Setting 
                            WHERE nameSetting = ?");

        if (!$stmt) {
            throw new Exception("Prepare failed: (" . $this->db->errno . ") " . $this->db->error);
        }

        // Bind the nameSetting parameter
        $stmt->bind_param('s', $nameSetting);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        // Bind the result variables
        $stmt->bind_result(
            $res_nameSetting,
            $res_statusName,
            $res_idDBTypeMySQL,
            $res_idDBTypePostgrade,
            $res_booleanValue,
            $res_decimalValue,
            $res_stringValue
        );

        // Fetch the result
        if ($stmt->fetch()) {
            // Create a Setting object with the retrieved data
            $setting = new Setting(
                $res_nameSetting,
                $res_statusName,
                (int) $res_idDBTypeMySQL,
                (int) $res_idDBTypePostgrade,
                (bool) $res_booleanValue,
                (float) $res_decimalValue,
                $res_stringValue
            );
        } else {
            // No setting found with the given name
            $setting = null;
        }

        // Close the statement
        $stmt->close();

        return $setting;
    }

    //COSTS
    function selectComputeInstanceCosts($companyName): array|null
    {
        // Prepare the SQL query
        $sql = "SELECT 
                    ci.name AS ComputeInstanceName,
                    (cpu.cost + i.cost + m.cost) AS TotalCost
                FROM ComputeInstance ci
                JOIN CPU cpu ON ci.model = cpu.model
                JOIN Image i ON ci.idImage = i.idImage
                JOIN Memory m ON ci.idMemory = m.idMemory
                WHERE ci.nameCompany = ?";

        // Prepare the statement
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            die("Statement preparation failed: " . $this->db->error);
        }

        // Bind the parameter
        $stmt->bind_param("s", $companyName);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch data into an array
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'ComputeInstanceName' => $row['ComputeInstanceName'],
                'TotalCost' => $row['TotalCost']
            ];
        }

        if (empty($data)) {
            return null;
        }

        // Return the data
        return $data;
    }

    function selectVCNCosts($companyName): array|null
    {
        // Prepare the SQL query
        $query = "SELECT VCN.nameVCN AS subnetName, Mask.cost AS subnetCost 
                  FROM VCN 
                  INNER JOIN Mask ON VCN.cidr = Mask.cidr 
                  WHERE VCN.nameCompany = ?";

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }

        // Bind the parameter
        $stmt->bind_param('s', $companyName);

        // Execute the statement
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }

        // Get the result
        $result = $stmt->get_result();

        // Fetch the data
        $subnets = [];
        while ($row = $result->fetch_assoc()) {
            $subnets[] = [
                'vcn' => $row['subnetName'],
                'cost' => $row['subnetCost']
            ];
        }
        if (empty($subnets)) {
            return null;
        }

        return $subnets;
    }

    function selectStorageCosts($companyName): array|null
    {
        $sql = "SELECT su.nameStorageU, s.cost 
                FROM StorageUnit su
                JOIN Storage s ON su.nameStorage = s.nameStorage
                WHERE su.nameCompany = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $companyName);
        $stmt->execute();
        $result = $stmt->get_result();

        $storageUnits = array();
        while ($row = $result->fetch_assoc()) {
            $storageUnits[] = [
                'storage' => $row['nameStorageU'],
                'cost' => $row['cost']
            ];
        }
        if (empty($storageUnits)) {
            return null;
        }
        return $storageUnits;
    }

    function selectDatabaseCosts($companyName): array|null {
        // Prepare the statement to call the stored procedure
        $stmt = $this->db->prepare("CALL get_databases_costs(?)");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->db->error);
        }
    
        // Bind the parameter
        $stmt->bind_param("s", $companyName);
    
        // Execute the stored procedure
        $stmt->execute();
    
        // Get the result set from the executed statement
        $result = $stmt->get_result();
        $output = [];
    
        // Fetch all rows into the output array
        while ($row = $result->fetch_assoc()) {
            $output[] = array(
                'db' => $row['nameDataBase'],
                'cost' => $row['cost']
            );
        }

        if (empty($output)) {
            return null;
        }
    
        // Return the array with database names and costs
        return $output;
    }

    //Privileges
    function isSuperAdmin():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("Super Admin", $privileges);
    }

    function isMaster():bool{
        $user = unserialize($_SESSION["user"]);
        return $user->getNameCompany() != null;
    }

    function canViewPayments():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("View Payments", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

    function canEditPrivileges():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);
        $idUserGroup = $user->getIdUserGroup();
        return in_array("Edit Privilegies", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

    function canEditUserGroup():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("Edit User Groups", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

    function canEditUsers():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("Edit Users", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

    function canEditCompany():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("Edit Company", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

    function canViewComputeInstances():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("View Compute Instances", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

    function canViewDataBases():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("View Data Bases", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

    function canViewStorageUnits():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("View Storage Units", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

    function canViewVCNs():bool{
        $user = unserialize($_SESSION["user"]);
        $idUserGroup = $user->getIdUserGroup();
        $privileges = $this->getPrivilegesByUserGroupId($idUserGroup);

        return in_array("View VCNs", $privileges) || $this->isSuperAdmin() || $this->isMaster();
    }

}

$dataBase = new MyDataBase($con);
?>