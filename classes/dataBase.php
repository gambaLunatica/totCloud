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

    //STORAGE: TO REVVIEW AND DO
    public function selectStorages(string $status = null): array
    {
        if ($status == null) {
            $sql = "SELECT idStorage,usedSpace,totalCapacity,IOSpeed,creationDate,typeName,nameStorage,cost FROM Storage";
        } else {
            $sql = "SELECT idStorage,usedSpace,totalCapacity,IOSpeed,creationDate,typeName,nameStorage,cost FROM Storage WHERE statusName = $status";
        }

        $result = $this->db->query($sql);

        $values = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values[] = new Storage($row["idStorage"], $row["usedSpace"], $row["totalCapacity"], $row["IOSpeed"],
                 $row["typeName"], $row["nameStorage"], $row["cost"]);
            }
        }
        return $values;
    }

    public function selectStorage(int $id): Storage|null
    {

        $sql = "SELECT idStorage,usedSpace,totalCapacity,IOSpeed,creationDate,typeName,nameStorage,cost FROM Storage WHERE idStorage = $id";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new Storage($row["idStorage"], $row["usedSpace"], $row["totalCapacity"], $row["IOSpeed"],
                $row["typeName"], $row["nameStorage"], $row["cost"]);
            }
        }
        return null;
    }

    public function insertStorage(Storage $storage): bool
    {
        try {
            $sql = "INSERT INTO Storage (usedSpace,totalCapacity,IOSpeed,typeName,nameStorage,cost)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->db->error);
            }

            $statusName = $storage->getStatusName();
            $totalCapacity = $storage->getTotalCapacity();
            $IOSpeed = $storage->getIOSpeed();
            $generation = $storage->getGeneration();
            $cost = $storage->getCost();

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

    public function updateStorage(Storage $storage): bool
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

            $statusName = $storage->getStatusName();
            $totalCapacity = $storage->getTotalCapacity();
            $IOSpeed = $storage->getIOSpeed();
            $generation = $storage->getGeneration();
            $cost = $storage->getCost();
            $idMemory = $storage->getIdMemory();


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
    public function deleteStorage(String $nombre): bool
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

}

$dataBase = new MyDataBase($con);
?>