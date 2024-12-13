CREATE DATABASE DBSyss;
USE DBSyss;

create table Privilege(
    namePrivilege VARCHAR(32) NOT NULL,

    PRIMARY KEY(namePrivilege)
);

create table Status(
    statusName VARCHAR(16) NOT NULL,
    PRIMARY KEY(statusName)
);

create table Region(
    nameRegion VARCHAR(32) NOT NULL,

    PRIMARY KEY(nameRegion)
);

create table Mask(
    cidr TINYINT UNSIGNED NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,

    PRIMARY KEY (cidr)
);

create table Company(
    nameCompany VARCHAR(32) NOT NULL UNIQUE,
    nameRegion VARCHAR(32) NOT NULL,
    

    PRIMARY KEY(nameCompany),
    FOREIGN KEY(nameRegion) REFERENCES Region(nameRegion)
);

create table UserGroup(
    idUserGroup INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameCompany VARCHAR(32) NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameUserGroup VARCHAR(32) NOT NULL,

    PRIMARY KEY(idUserGroup),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    UNIQUE(nameUserGroup, nameCompany)
);
create table PrivilegeStatus(
    namePrivilege VARCHAR(32) NOT NULL,
    idUserGroup INT UNSIGNED NOT NULL,
    value BIT NOT NULL,

    PRIMARY KEY(namePrivilege, idUserGroup),
    FOREIGN KEY(namePrivilege) REFERENCES Privilege(namePrivilege),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup)
);

create table MyUser(
    realName VARCHAR(32) NOT NULL,
    realSurname VARCHAR(32) NOT NULL,
    email VARCHAR(64) NOT NULL UNIQUE,
    password VARCHAR(256) NOT NULL,
    idUserGroup INT UNSIGNED NOT NULL,
    nameCompany VARCHAR(32) NULL,

    PRIMARY KEY(email),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany)
);

create table VCN(
    cidr TINYINT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameCompany VARCHAR(32) NOT NULL,
    nameRegion VARCHAR(32) NOT NULL,
    privateIP BINARY(4) NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameVCN VARCHAR(32) NOT NULL,

    PRIMARY KEY(idVCN),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    FOREIGN KEY(nameRegion) REFERENCES Region(nameRegion),
    FOREIGN KEY(cidr) REFERENCES Mask(cidr)
);
create table Subnet(
    cidr TINYINT UNSIGNED NOT NULL,
    idSubnet INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idVCN INT UNSIGNED NOT NULL,
    IP BINARY(4) NOT NULL,
    nameSubnet VARCHAR(32) NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(idSubnet),
    FOREIGN KEY(idVCN) REFERENCES VCN(idVCN)
);
create table Public(
    idSubnet INT UNSIGNED NOT NULL AUTO_INCREMENT,
    publicIP BINARY(4) NOT NULL UNIQUE,

    PRIMARY KEY(idSubnet),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet)
);

create table Generation(
    generation VARCHAR(32) NOT NULL,
    PRIMARY KEY(generation)
);

create table Speed(
    IOSpeed FLOAT UNSIGNED NOT NULL,
    PRIMARY KEY (IOSpeed)
);

create table Type(
    typeName VARCHAR(16) NOT NULL,
    PRIMARY KEY(typeName)
);

create table Size(
    totalCapacity FLOAT UNSIGNED NOT NULL,
    PRIMARY KEY(totalCapacity)
);

create table Memory(
    idMemory INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    totalCapacity FLOAT UNSIGNED NOT NULL,
    IOSpeed FLOAT UNSIGNED NOT NULL,
    generation VARCHAR(32) NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,

    PRIMARY KEY (idMemory),
    FOREIGN KEY(generation) REFERENCES Generation(generation),
    FOREIGN KEY(totalCapacity) REFERENCES Size(totalCapacity),
    FOREIGN KEY(IOSpeed) REFERENCES Speed(IOSpeed),
    FOREIGN KEY(statusName) REFERENCES Status(statusName),
    CONSTRAINT unique_ram_combination UNIQUE (IOSpeed, totalCapacity, generation)
);

create table Series(
    series VARCHAR(32) NOT NULL,

    PRIMARY KEY(series)
);

create table CPU(
    statusName VARCHAR(16) NOT NULL,
    coreCount INT UNSIGNED NOT NULL,
    cacheL1 FLOAT UNSIGNED NOT NULL,
    cacheL2 FLOAT UNSIGNED NULL,
    cacheL3 FLOAT UNSIGNED NULL,
    frequency FLOAT UNSIGNED NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,
    model VARCHAR(32) NOT NULL,
    series VARCHAR(32) NOT NULL,

    PRIMARY KEY (model),
    FOREIGN KEY(series) REFERENCES Series(series),
    FOREIGN KEY(statusName) REFERENCES Status(statusName)

);

create table CompatibilityMemoryCPU(
    model VARCHAR(32) NOT NULL,
    idMemory INT UNSIGNED NOT NULL,

    PRIMARY KEY(model, idMemory),
    FOREIGN KEY(model) REFERENCES CPU(model),
    FOREIGN key(idMemory) REFERENCES Memory(idMemory),
    CONSTRAINT unique_memory_combination UNIQUE(model, idMemory)
);

create table OS(
    osName VARCHAR(32) NOT NULL,

    PRIMARY KEY(osName)
);

create table Image(
    idImage INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,
    osName VARCHAR(32) NOT NULL,
    build VARCHAR(64) NULL,
    
    PRIMARY KEY(idImage),
    FOREIGN key(osName) REFERENCES OS(osName),
    FOREIGN key(statusName) REFERENCES Status(statusName)
);

create table ComputeInstance(
    idComputeInstance INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idSubnet INT UNSIGNED NOT NULL,
    nameCompany VARCHAR(32) NOT NULL,
    idMemory INT UNSIGNED NOT NULL,
    idImage INT UNSIGNED NOT NULL,
    model VARCHAR(32) NOT NULL,
    name VARCHAR(32) NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    sshKey BLOB(512) NULL,

    PRIMARY KEY(idComputeInstance),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    FOREIGN KEY(idMemory) REFERENCES Memory(idMemory),
    FOREIGN KEY(model) REFERENCES CPU(model),
    FOREIGN KEY(idImage) REFERENCES Image(idImage)
);

create table CompatibilityCPUImage(
    model VARCHAR(32) NOT NULL,
    idImage INT UNSIGNED NOT NULL,

    PRIMARY KEY(model, idImage),
    FOREIGN KEY(model) REFERENCES CPU(model),
    FOREIGN KEY(idImage) REFERENCES Image(idImage),
    CONSTRAINT unique_image_combination UNIQUE(model, idImage)
);

create table Storage(
    totalCapacity FLOAT UNSIGNED NOT NULL,
    IOSpeed FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) NOT NULL,
    nameStorage VARCHAR(32) NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,
    statusName VARCHAR(16) NOT NULL,

    PRIMARY KEY(nameStorage),
    FOREIGN KEY(IOSpeed) REFERENCES Speed(IOSpeed),
    FOREIGN KEY(typeName) REFERENCES Type(typeName),
    FOREIGN KEY(totalCapacity) REFERENCES Size(totalCapacity),
    FOREIGN key(statusName) REFERENCES Status(statusName),
    CONSTRAINT unique_storage_combination UNIQUE(IOSpeed, totalCapacity, typeName)
);


create table StorageUnit(
    idStorageUnit INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameCompany VARCHAR(32) NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    usedSpace FLOAT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameStorageU VARCHAR(32) NOT NULL,
    idUserGroup INT UNSIGNED NOT NULL,
    nameStorage VARCHAR(32) NOT NULL,

    PRIMARY KEY(idStorageUnit),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet),
    FOREIGN KEY(idComputeInstance) REFERENCES ComputeInstance(idComputeInstance),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup),
    FOREIGN KEY(nameStorage) REFERENCES Storage(nameStorage)
);

create table DBTypePostgrade(
    idDBType INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    cost FLOAT NOT NULL,
    releaseDate DATE NOT NULL,
    build VARCHAR(32) UNIQUE,

    PRIMARY KEY(idDBType),
    FOREIGN KEY(statusName) REFERENCES Status(statusName)
);

create table DBTypeMySql(
    idDBType INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    cost FLOAT NOT NULL,
    releaseDate DATE NOT NULL,
    version VARCHAR(8) UNIQUE,

    PRIMARY KEY(idDBType),
    FOREIGN KEY(statusName) REFERENCES Status(statusName)
);

create table MyDataBase(
    idDataBase INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameCompany VARCHAR(32) NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    idDBTypeMySQL INT UNSIGNED NULL,
    idDBTypePostgrade INT UNSIGNED NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameDataBase VARCHAR(32) NOT NULL,
    description VARCHAR(512) NULL,

    PRIMARY KEY(idDataBase),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet),
    FOREIGN key(idComputeInstance) REFERENCES ComputeInstance(idComputeInstance),
    FOREIGN KEY(idDBTypeMySQL) REFERENCES DBTypeMySql(idDBType),
    FOREIGN KEY(idDBTypePostgrade) REFERENCES DBTypePostgrade(idDBType)
);

create table MyTable(
    idTable INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameTable VARCHAR(32) NOT NULL,
    idDataBase INT UNSIGNED NOT NULL,

    PRIMARY KEY(idTable),
    FOREIGN KEY(idDataBase) REFERENCES MyDataBase(idDataBase)
);

create table Instruction(
    idInstruction INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idTable INT UNSIGNED NOT NULL,
    nameInstruction VARCHAR(1024) NOT NULL,
    inputDate DATETIME NOT NULL  DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(idInstruction),
    FOREIGN KEY(idTable) REFERENCES MyTable(idTable)
);
create table Setting(
    nameSetting VARCHAR(32) NOT NULL,
    statusName VARCHAR(16) NOT NULL,
    idDBTypePostgrade INT UNSIGNED,
    idDBTypeMySQL INT UNSIGNED,
    booleanValue BOOLEAN,
    decimalValue FLOAT,
    stringValue VARCHAR(128),

    PRIMARY KEY(nameSetting),
    FOREIGN KEY(statusName) REFERENCES Status(statusName),
    FOREIGN KEY(idDBTypePostgrade) REFERENCES DBTypePostgrade(idDBType),
    FOREIGN KEY(idDBTypeMySQL) REFERENCES DBTypeMySql(idDBType)
);

create table DBConfiguration(
    idDataBase INT UNSIGNED NOT NULL,
    nameSetting VARCHAR(32) NOT NULL,
    booleanValue BOOLEAN,
    decimalValue FLOAT,
    stringValue VARCHAR(128),

    PRIMARY KEY(idDataBase, nameSetting),
    FOREIGN KEY(idDataBase) REFERENCES MyDataBase(idDataBase),
    FOREIGN KEY(nameSetting) REFERENCES Setting(nameSetting)
);

create table MyUsage(
    idMyUsage INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idComputeCPU INT UNSIGNED,
    idComputeMEM INT UNSIGNED,
    idStorageUnit INT UNSIGNED,
    idVCN INT UNSIGNED,
    idDataBase INT UNSIGNED,
    value FLOAT,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(idMyUsage),
    FOREIGN KEY(idComputeCPU) REFERENCES ComputeInstance(idComputeInstance),
    FOREIGN KEY(idComputeMem) REFERENCES ComputeInstance(idComputeInstance),
    FOREIGN KEY(idVCN) REFERENCES VCN(idVCN),
    FOREIGN KEY(idDataBase) REFERENCES MyDataBase(idDataBase),
    FOREIGN KEY(idStorageUnit) REFERENCES StorageUnit(idStorageUnit)
);

Insert into Privilege(namePrivilege) VALUES
("View Payments"),
("Super Admin"),
("Edit Privilegies"),
("Edit User Groups"),
("Edit Users"),
("Edit Company"),
("View Data Bases"),
("View Compute Instances"),
("View Storage Units"),
("View VCNs");

DELIMITER $$

-- Funcion para registrar una compañia y crear el usuario Master
CREATE FUNCTION RegisterCompany(
    nameCompanyPar VARCHAR(32), 
    nameRegionPar VARCHAR(32),
    realNamePar VARCHAR(32),
    realSurnamePar VARCHAR(32),
    emailPar VARCHAR(64),
    passwordPar VARCHAR(256)
) RETURNS INT
BEGIN
    DECLARE companyExists INT;
    DECLARE userExists INT;
    DECLARE groupId INT;

    -- Check if the company already exists
    SELECT COUNT(*) INTO companyExists
    FROM Company c
    WHERE c.nameCompany = nameCompanyPar;

    -- Check if the user already exists
    SELECT COUNT(*) INTO userExists
    FROM MyUser u
    WHERE u.email = emailPar;

    -- If either the company or user exists, return -1
    IF companyExists > 0 OR userExists > 0 THEN
        RETURN -1;
    END IF;

    -- Insert into Company table
    INSERT INTO Company (nameCompany, nameRegion)
    VALUES (nameCompanyPar, nameRegionPar);

    -- Insert into UserGroup table
    INSERT INTO UserGroup (nameUserGroup, nameCompany)
    VALUES ('Administrators', nameCompanyPar);

    -- Retrieve the ID of the UserGroup
    SET groupId = LAST_INSERT_ID();

    -- Insert into MyUser table
    INSERT INTO MyUser (realName, realSurname, email, `password`, idUserGroup, nameCompany)
    VALUES (realNamePar, realSurnamePar, emailPar, passwordPar, groupId, nameCompanyPar);

    -- Return the UserGroup ID
    RETURN groupId;
END$$

-- procedure para añadir a un grupo de usuario todos o ningun permiso;
CREATE PROCEDURE InsertPrivilegeStatus(
    IN idUserGroupPar INT UNSIGNED,
    IN valuePar BIT
)
BEGIN
    INSERT INTO PrivilegeStatus (namePrivilege, idUserGroup, value) 
    VALUES ("View Payments", idUserGroupPar, valuePar),
    ("Edit Privilegies", idUserGroupPar, valuePar),
    ("Edit User Groups", idUserGroupPar, valuePar),
    ("Edit Users", idUserGroupPar, valuePar),
    ("Edit Company", idUserGroupPar, valuePar),
    ("View Data Bases", idUserGroupPar, valuePar),
    ("View Compute Instances", idUserGroupPar, valuePar),
    ("View Storage Units", idUserGroupPar, valuePar),
    ("View VCNs", idUserGroupPar, valuePar);
END$$

DELIMITER ;

INSERT INTO Region (nameRegion)
VALUES
    ('United States'),
    ('Canada'),
    ('Mexico'),
    ('Brazil'),
    ('Argentina'),
    ('United Kingdom'),
    ('Germany'),
    ('France'),
    ('Italy'),
    ('Spain'),
    ('Russia'),
    ('China'),
    ('India'),
    ('Japan'),
    ('South Korea'),
    ('Australia'),
    ('South Africa'),
    ('Nigeria'),
    ('Egypt'),
    ('Saudi Arabia'),
    ('Turkey');

-- PSW admin
SELECT RegisterCompany("TotCloud", "Spain", "Master", "Admin", "admin@gmail.com", "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918");

INSERT INTO PrivilegeStatus (namePrivilege, idUserGroup, value) 
    VALUES ("Super Admin", 1, 1);

INSERT INTO status (statusName) 
VALUES
("Prerelease"),
("Live"),
("Test");  


INSERT INTO Series(series) 
VALUES
    ("AMD"),
    ("Intel");

INSERT INTO OS(osName)
VALUES
    ("Windows"),
    ("Linux");

    DELIMITER $$

-- Funcion que añade un setting a un tipo de base de datios (Postgre y/o mysql) y actualiza todas las bases
-- de datos existentes para que tengan el mismo permiso con el valor por defecto
CREATE PROCEDURE AddSetting(
    IN in_nameSetting VARCHAR(32),
    IN in_statusName VARCHAR(16),
    IN in_idDBTypePostgrade INT UNSIGNED,
    IN in_idDBTypeMySQL INT UNSIGNED,
    IN in_booleanValue BOOLEAN,
    IN in_decimalValue FLOAT,
    IN in_stringValue VARCHAR(128)
)
BEGIN
    -- Insert into Setting table
    INSERT INTO Setting(
        nameSetting, statusName, idDBTypePostgrade, idDBTypeMySQL, booleanValue, decimalValue, stringValue
    ) VALUES (
        in_nameSetting, in_statusName, in_idDBTypePostgrade, in_idDBTypeMySQL, in_booleanValue, in_decimalValue, in_stringValue
    );

    -- Only proceed if statusName is 'Live'
    IF in_statusName = 'Live' THEN
        IF in_idDBTypePostgrade IS NOT NULL THEN
            INSERT INTO DBConfiguration(idDataBase, nameSetting, booleanValue, decimalValue, stringValue)
            SELECT idDataBase, in_nameSetting, in_booleanValue, in_decimalValue, in_stringValue
            FROM MyDataBase
            WHERE idDBTypePostgrade = in_idDBTypePostgrade;
        END IF;

        IF in_idDBTypeMySQL IS NOT NULL THEN
            INSERT INTO DBConfiguration(idDataBase, nameSetting, booleanValue, decimalValue, stringValue)
            SELECT idDataBase, in_nameSetting, in_booleanValue, in_decimalValue, in_stringValue
            FROM MyDataBase
            WHERE idDBTypeMySQL = in_idDBTypeMySQL;
        END IF;
    END IF;
END$$

-- Funcion para eliminar un setting y todas las configuraciones relacionadas a ese setting
CREATE PROCEDURE DeleteSetting(
    IN in_nameSetting VARCHAR(32)
)
BEGIN
    -- Delete from DBConfiguration where nameSetting matches
    DELETE FROM DBConfiguration
    WHERE nameSetting = in_nameSetting;

    -- Delete from Setting where nameSetting matches
    DELETE FROM Setting
    WHERE nameSetting = in_nameSetting;
END$$

-- Funcion para crear una base de datos y obtener todos los settings con los valores por defecto
CREATE PROCEDURE createDatabase(
    IN p_nameCompany VARCHAR(32),
    IN p_idSubnet INT UNSIGNED,
    IN p_idComputeInstance INT UNSIGNED,
    IN p_idDBTypeMySQL INT UNSIGNED,
    IN p_idDBTypePostgrade INT UNSIGNED,
    IN p_nameDataBase VARCHAR(32),
    IN p_description VARCHAR(512),
    IN numRows INT
)
BEGIN
	DECLARE i INT DEFAULT 0;
    DECLARE new_idDataBase INT;
    -- Insert into MyDataBase
    INSERT INTO MyDataBase(
        nameCompany,
        idSubnet,
        idComputeInstance,
        idDBTypeMySQL,
        idDBTypePostgrade,
        nameDataBase,
        description
    ) VALUES (
        p_nameCompany,
        p_idSubnet,
        p_idComputeInstance,
        p_idDBTypeMySQL,
        p_idDBTypePostgrade,
        p_nameDataBase,
        p_description
    );
    -- Retrieve the newly inserted idDataBase
    SET @new_idDataBase = LAST_INSERT_ID();

    -- Insert settings for MySQL DB type
    IF p_idDBTypeMySQL IS NOT NULL THEN
        INSERT INTO DBConfiguration(idDataBase, nameSetting, booleanValue, decimalValue, stringValue)
        SELECT
            @new_idDataBase,
            s.nameSetting,
            s.booleanValue,
            s.decimalValue,
            s.stringValue
        FROM Setting s
        WHERE s.idDBTypeMySQL = p_idDBTypeMySQL;
    END IF;

    -- Insert settings for Postgrade DB type
    IF p_idDBTypePostgrade IS NOT NULL THEN
        INSERT INTO DBConfiguration(idDataBase, nameSetting, booleanValue, decimalValue, stringValue)
        SELECT
            @new_idDataBase,
            s.nameSetting,
            s.booleanValue,
            s.decimalValue,
            s.stringValue
        FROM Setting s
        WHERE s.idDBTypePostgrade = p_idDBTypePostgrade;
    END IF;

    WHILE i < numRows DO
        INSERT INTO MyUsage (
            idComputeCPU, idComputeMEM, idStorageUnit, idVCN, idDataBase, value, creationDate
        ) VALUES (
            NULL, NULL, NULL, NULL, @new_idDataBase, RAND() * 100, DATE_SUB(NOW(), INTERVAL i HOUR)
        );
        SET i = i + 1;
    END WHILE;
END$$

-- procedure para elminar una base de datos correctamente
CREATE PROCEDURE deleteDatabase(
    IN p_idDataBase INT UNSIGNED
)
BEGIN

    DELETE Instruction
    FROM Instruction
    JOIN MyTable ON Instruction.idTable = MyTable.idTable
    WHERE MyTable.idDataBase = p_idDataBase;

    DELETE FROM MyTable
    WHERE MyTable.idDataBase = p_idDataBase;

    -- Delete associated configurations
    DELETE FROM DBConfiguration WHERE idDataBase = p_idDataBase;

    DELETE FROM MyUsage WHERE idDataBase = p_idDataBase;

    -- Delete the database entry
    DELETE FROM MyDataBase WHERE idDataBase = p_idDataBase;
END$$

CREATE PROCEDURE get_databases_costs(IN cCompanyName VARCHAR(32))
BEGIN
    SELECT 
        m.nameDataBase,
        CASE
            WHEN m.idDBTypeMySQL IS NOT NULL THEN 
                (SELECT cost FROM DBTypeMySql WHERE idDBType = m.idDBTypeMySQL)
            WHEN m.idDBTypePostgrade IS NOT NULL THEN 
                (SELECT cost FROM DBTypePostgrade WHERE idDBType = m.idDBTypePostgrade)
            ELSE 
                NULL
        END AS cost
    FROM MyDataBase m
    WHERE m.nameCompany = cCompanyName;
END $$

-- Deletes the usergroup and the privileges
CREATE PROCEDURE DeleteUserGroupAndPrivileges(IN p_idUserGroup INT UNSIGNED)
BEGIN
    -- First delete the PrivilegeStatus rows for this user group
    DELETE FROM PrivilegeStatus
    WHERE idUserGroup = p_idUserGroup;

    -- Then delete the user group
    DELETE FROM UserGroup
    WHERE idUserGroup = p_idUserGroup;
END$$

CREATE PROCEDURE InsertComputeInstanceCPUUsage(IN idInstance INT, IN numRows INT)
BEGIN
    DECLARE i INT DEFAULT 0;
    WHILE i < numRows DO
        INSERT INTO MyUsage (idComputeCPU, idComputeMEM, idStorageUnit, idVCN, idDataBase, value, creationDate)
        VALUES (idInstance, NULL, NULL, NULL, NULL, RAND() * 100, DATE_SUB(NOW(), INTERVAL i HOUR));
        SET i = i + 1;
    END WHILE;
END$$

CREATE PROCEDURE InsertComputeInstanceRAMUsage(IN idInstance INT, IN numRows INT)
BEGIN
    DECLARE i INT DEFAULT 0;
    WHILE i < numRows DO
        INSERT INTO MyUsage (idComputeCPU, idComputeMEM, idStorageUnit, idVCN, idDataBase, value, creationDate)
        VALUES (NULL, idInstance, NULL, NULL, NULL, RAND() * 100, DATE_SUB(NOW(), INTERVAL i HOUR));
        SET i = i + 1;
    END WHILE;
END$$

CREATE PROCEDURE InsertStorageUnitUsage(IN idStorage INT, IN numRows INT)
BEGIN
    DECLARE i INT DEFAULT 0;
    WHILE i < numRows DO
        INSERT INTO MyUsage (idComputeCPU, idComputeMEM, idStorageUnit, idVCN, idDataBase, value, creationDate)
        VALUES (NULL, NULL, idStorage, NULL, NULL, RAND() * 100, DATE_SUB(NOW(), INTERVAL i HOUR));
        SET i = i + 1;
    END WHILE;
END$$

CREATE PROCEDURE InsertVCNUsage(IN idVCN INT, IN numRows INT)
BEGIN
    DECLARE i INT DEFAULT 0;
    WHILE i < numRows DO
        INSERT INTO MyUsage (idComputeCPU, idComputeMEM, idStorageUnit, idVCN, idDataBase, value, creationDate)
        VALUES (NULL, NULL, NULL, idVCN, NULL, RAND() * 100, DATE_SUB(NOW(), INTERVAL i HOUR));
        SET i = i + 1;
    END WHILE;
END$$

CREATE PROCEDURE InsertDatabaseUsage(IN idDataBase INT, IN numRows INT)
BEGIN
    DECLARE i INT DEFAULT 0;
    WHILE i < numRows DO
        INSERT INTO MyUsage (idComputeCPU, idComputeMEM, idStorageUnit, idVCN, idDataBase, value, creationDate)
        VALUES (NULL, NULL, NULL, NULL, idDataBase, RAND() * 100, DATE_SUB(NOW(), INTERVAL i HOUR));
        SET i = i + 1;
    END WHILE;
END$$


DELIMITER ;

insert into speed (IOSpeed) values (10);
insert into size (TotalCapacity) values (32);
insert into generation (generation) values ("DDR5");
insert into image (statusName, cost, osName, build) values ("Live", 5, "Windows", "22H2");
insert into memory (statusName, totalCapacity, IOSpeed, generation, cost) VALUES ("Live", 32, 10, "DDR5", 67);
insert into mask (cidr, cost) values (16, 15);
insert into vcn (cidr, nameCompany, nameRegion, privateIP, nameVCN) values (16, "TotCloud", "Argentina", INET_ATON('10.0.0.0'), "BaseVCN");
insert into cpu (statusName, coreCount, cacheL1, cacheL2, cacheL3, frequency, cost, model, series) values ("Live", 6, 10, 0, 0, 3.6, 250, "Ryzen 6 1600Z", "AMD");
insert into compatibilitycpuimage (model, idImage) values ("Ryzen 6 1600Z", 1);
insert into compatibilitymemorycpu (model, idMemory) values ("Ryzen 6 1600Z", 1);
insert into subnet (cidr, idVCN, IP, nameSubnet) values (16,1, INET_ATON('10.0.0.0'), "Public");
INSERT INTO ComputeInstance (idSubnet, nameCompany, idMemory, idImage, model, name) values (1, "TotCloud", 1, 1, "Ryzen 6 1600Z", "Test CI");

INSERT INTO Speed (IOSpeed) VALUES (0.5);
INSERT INTO Size (totalCapacity) VALUES (2000);
INSERT INTO Type (typeName) VALUES ('SSD');
INSERT INTO Storage (totalCapacity,IOSpeed,typeName,nameStorage,cost,statusName) VALUES (2000, 0.5, 'SSD', '2TB SSD', 78, 'Live');
insert into storageunit (nameCompany, idSubnet, idComputeInstance, usedSpace, nameStorageU, idUserGroup, nameStorage) values ("TotCloud", 1, 1, 0, "Basic SU", 1, "2TB SSD");

INSERT INTO DBTypeMySql (statusName,cost,releaseDate,version) VALUES ('Live', 32, '2024-12-06', '1.0.0');
INSERT INTO DBTypePostgrade (statusName,cost,releaseDate,build)  VALUES ('Live', 40, '2024-12-06', 'dfsgs');
insert into MyDataBase (nameCompany, idSubnet, idComputeInstance, idDBTypeMySQL, nameDatabase) values ("TotCloud", 1, 1, 1, "MySQL TST");
insert into MyDataBase (nameCompany, idSubnet, idComputeInstance, idDBTypePostgrade, nameDatabase) values ("TotCloud", 1, 1, 1, "Postgre TST");


-- BACKUPS
SET GLOBAL event_scheduler = ON;

CREATE TABLE StorageUnitBackup (
    backupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    backupDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idStorageUnit INT UNSIGNED NOT NULL,
    nameCompany VARCHAR(32) NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    usedSpace FLOAT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL,
    nameStorageU VARCHAR(32) NOT NULL,
    idUserGroup INT UNSIGNED NOT NULL,
    nameStorage VARCHAR(32) NOT NULL,
    PRIMARY KEY (backupID)
);

CREATE TABLE ComputeInstanceBackup (
    backupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    backupDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idComputeInstance INT UNSIGNED NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    nameCompany VARCHAR(32) NOT NULL,
    idMemory INT UNSIGNED NOT NULL,
    idImage INT UNSIGNED NOT NULL,
    model VARCHAR(32) NOT NULL,
    name VARCHAR(32) NOT NULL,
    creationDate DATETIME NOT NULL,
    sshKey BLOB(512),
    PRIMARY KEY (backupID)
);

CREATE TABLE VCNBackup (
    backupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    backupDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idVCN INT UNSIGNED NOT NULL,
    nameCompany VARCHAR(32) NOT NULL,
    nameRegion VARCHAR(32) NOT NULL,
    cidr TINYINT UNSIGNED NOT NULL,
    privateIP BINARY(4) NOT NULL,
    creationDate DATETIME NOT NULL,
    nameVCN VARCHAR(32) NOT NULL,
    PRIMARY KEY (backupID)
);

CREATE TABLE SubnetBackup (
    backupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    backupDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idSubnet INT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL,
    cidr TINYINT UNSIGNED NOT NULL,
    IP BINARY(4) NOT NULL,
    nameSubnet VARCHAR(32) NOT NULL,
    creationDate DATETIME NOT NULL,
    PRIMARY KEY (backupID)
);

CREATE TABLE MyDataBaseBackup (
    backupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    backupDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idDataBase INT UNSIGNED NOT NULL,
    nameCompany VARCHAR(32) NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    idDBTypeMySQL INT UNSIGNED NULL,
    idDBTypePostgrade INT UNSIGNED NULL,
    creationDate DATETIME NOT NULL,
    nameDataBase VARCHAR(32) NOT NULL,
    description VARCHAR(512),
    PRIMARY KEY (backupID)
);

CREATE TABLE MyTableBackup (
    backupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    backupDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idTable INT UNSIGNED NOT NULL,
    nameTable VARCHAR(32) NOT NULL,
    idDataBase INT UNSIGNED NOT NULL,
    PRIMARY KEY (backupID)
);

CREATE TABLE InstructionBackup (
    backupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    backupDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idInstruction INT UNSIGNED NOT NULL,
    idTable INT UNSIGNED NOT NULL,
    nameInstruction VARCHAR(1024) NOT NULL,
    inputDate DATETIME NOT NULL  DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (backupID)
);

CREATE TABLE SettingBackup (
    backupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    backupDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameSetting VARCHAR(32) NOT NULL,
    statusName VARCHAR(16) NOT NULL,
    idDBTypePostgrade INT UNSIGNED NULL,
    idDBTypeMySQL INT UNSIGNED NULL,
    booleanValue BOOLEAN NULL,
    decimalValue FLOAT NULL,
    stringValue VARCHAR(128) NULL,
    PRIMARY KEY (backupID)
);

-- EVENTOS DE BACKUP

CREATE EVENT BackupComputeInstance
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
INSERT INTO ComputeInstanceBackup (
    idComputeInstance, idSubnet, nameCompany, idMemory, idImage, model, 
    name, creationDate, sshKey
)
SELECT
    idComputeInstance, idSubnet, nameCompany, idMemory, idImage, model, 
    name, creationDate, sshKey
FROM ComputeInstance;

CREATE EVENT BackupVCN
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
INSERT INTO VCNBackup (
    idVCN, nameCompany, nameRegion, cidr, privateIP, creationDate, nameVCN
)
SELECT
    idVCN, nameCompany, nameRegion, cidr, privateIP, creationDate, nameVCN
FROM VCN;

CREATE EVENT BackupSubnet
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
INSERT INTO SubnetBackup (
    idSubnet, idVCN, cidr, IP, nameSubnet, creationDate
)
SELECT
    idSubnet, idVCN, cidr, IP, nameSubnet, creationDate
FROM Subnet;

CREATE EVENT BackupMyDataBase
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
INSERT INTO MyDataBaseBackup (
    idDataBase, nameCompany, idSubnet, idComputeInstance, idDBTypeMySQL, 
    idDBTypePostgrade, creationDate, nameDataBase, description
)
SELECT
    idDataBase, nameCompany, idSubnet, idComputeInstance, idDBTypeMySQL, 
    idDBTypePostgrade, creationDate, nameDataBase, description
FROM MyDataBase;

CREATE EVENT BackupMyTable
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
INSERT INTO MyTableBackup (
    idTable, nameTable, idDataBase
)
SELECT
    idTable, nameTable, idDataBase
FROM MyTable;

CREATE EVENT BackupInstruction
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
INSERT INTO InstructionBackup (
    idInstruction, idTable, nameInstruction, inputDate
)
SELECT
    idInstruction, idTable, nameInstruction, inputDate
FROM Instruction;

CREATE EVENT BackupSetting
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
INSERT INTO SettingBackup (
    nameSetting, statusName, idDBTypePostgrade, idDBTypeMySQL, 
    booleanValue, decimalValue, stringValue
)
SELECT
    nameSetting, statusName, idDBTypePostgrade, idDBTypeMySQL, 
    booleanValue, decimalValue, stringValue
FROM Setting;