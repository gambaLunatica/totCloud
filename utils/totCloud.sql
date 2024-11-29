CREATE DATABASE totCloud;
USE totCloud;

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
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany)
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
    nameCompany VARCHAR(32) NOT NULL,

    PRIMARY KEY(email),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany)
);

create table PaymentMethod(
    nameMethod VARCHAR(32) NOT NULL,

    PRIMARY KEY(nameMethod)
);
create table VCN(
    cidr TINYINT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameCompany VARCHAR(32) NOT NULL,
    nameRegion VARCHAR(32) NOT NULL,
    privateIP BINARY(4) NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    name VARCHAR(32) NOT NULL,

    PRIMARY KEY(idVCN),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    FOREIGN KEY(nameRegion) REFERENCES Region(nameRegion),
    FOREIGN KEY(cidr) REFERENCES Mask(cidr)
);
create table Subnet(
    cidr TINYINT UNSIGNED NOT NULL,
    idSubnet INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idVCN INT UNSIGNED NOT NULL,
    privateIP BINARY(4) NOT NULL,
    name VARCHAR(32) NOT NULL,

    PRIMARY KEY(idSubnet),
    FOREIGN KEY(idVCN) REFERENCES VCN(idVCN)
);
create table Public(
    idSubnet INT UNSIGNED NOT NULL AUTO_INCREMENT,
    privateIP BINARY(4) NOT NULL UNIQUE,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(idSubnet),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet)
);
create table Payment(
    idPayment INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameCompany VARCHAR(32) NOT NULL,
    nameMethod VARCHAR(32) NOT NULL,
    quantity FLOAT NOT NULL,
    paymentDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(idPayment),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    FOREIGN KEY(nameMethod) REFERENCES PaymentMethod(nameMethod)
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
    typeName VARCHAR(16) NOT NULL,
    generation VARCHAR(32) NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,

    PRIMARY KEY (idMemory),
    FOREIGN KEY(generation) REFERENCES Generation(generation),
    FOREIGN KEY(totalCapacity) REFERENCES Size(totalCapacity),
    FOREIGN KEY(typeName) REFERENCES Type(typeName),
    FOREIGN KEY(IOSpeed) REFERENCES Speed(IOSpeed),
    FOREIGN KEY(statusName) REFERENCES Status(statusName)

);

create table Series(
    series VARCHAR(32) NOT NULL,
    PRIMARY KEY(series)
);

create table CPU(
    statusName VARCHAR(16) NOT NULL,
    coreCount INT UNSIGNED NOT NULL,
    cacheL1 INT UNSIGNED NOT NULL,
    cacheL2 INT UNSIGNED NULL,
    cacheL3 INT UNSIGNED NULL,
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
    FOREIGN key(idMemory) REFERENCES Memory(idMemory)
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
    FOREIGN KEY(idImage) REFERENCES Image(idImage)
);



create table Storage(
    idStorage INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameCompany VARCHAR(32) NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    usedSpace FLOAT UNSIGNED NOT NULL,
    totalCapacity FLOAT UNSIGNED NOT NULL,
    IOSpeed FLOAT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    typeName VARCHAR(16) NOT NULL,
    name VARCHAR(32) NOT NULL,

    PRIMARY KEY(idStorage),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet),
    FOREIGN KEY(idComputeInstance) REFERENCES ComputeInstance(idComputeInstance),
    FOREIGN KEY(IOSpeed) REFERENCES Speed(IOSpeed),
    FOREIGN KEY(typeName) REFERENCES Type(typeName),
    FOREIGN KEY(totalCapacity) REFERENCES Size(totalCapacity)

);

create table CompatibilitySpeedType(
    IOSpeed FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) NOT NULL,

    PRIMARY KEY(IOSpeed, typeName),
    FOREIGN KEY(IOSpeed) REFERENCES Speed(IOSpeed),
    FOREIGN KEY(typeName) REFERENCES Type(typeName)
);

create table CompatibilityTypeSize(
    totalCapacity FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) NOT NULL,

    PRIMARY KEY(totalCapacity, typeName),
    FOREIGN KEY(totalCapacity) REFERENCES Size(totalCapacity),
    FOREIGN KEY(typeName) REFERENCES Type(typeName)
);

create table DBTypePostgrade(
    idDBType INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    cost FLOAT NOT NULL,
    releaseDate DATE NOT NULL,
    build VARCHAR(32),

    PRIMARY KEY(idDBType),
    FOREIGN KEY(statusName) REFERENCES Status(statusName)
);

create table DBTypeMySql(
    idDBType INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    cost FLOAT NOT NULL,
    releaseDate DATE NOT NULL,
    version VARCHAR(8),

    PRIMARY KEY(idDBType),
    FOREIGN KEY(statusName) REFERENCES Status(statusName)
);

create table MyDataBase(
    idDataBase INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameCompany VARCHAR(32) NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    idDBType INT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameDataBase VARCHAR(32) NOT NULL,
    description VARCHAR(512) NULL,

    PRIMARY KEY(idDataBase),
    FOREIGN KEY(nameCompany) REFERENCES Company(nameCompany),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet),
    FOREIGN key(idComputeInstance) REFERENCES ComputeInstance(idComputeInstance),
    FOREIGN KEY(idDBType) REFERENCES DBTypeMySql(idDBType)

);

create table MyTable(
    idTable INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameTable VARCHAR(32) NOT NULL,
    idDataBase INT UNSIGNED NOT NULL,

    PRIMARY KEY(idTable),
    FOREIGN KEY(idDataBase) REFERENCES MyDataBase(idDataBase)
);

create table PermissionGroupDB(
    idUserGroup INT UNSIGNED NOT NULL,
    idDataBase INT UNSIGNED NOT NULL,

    PRIMARY KEY(idUserGroup, idDataBase),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup),
    FOREIGN KEY(idDataBase) REFERENCES MyDataBase(idDataBase)
);

create table PermissionGroupStorage(
    idUserGroup INT UNSIGNED NOT NULL,
    idStorage INT UNSIGNED NOT NULL,

    PRIMARY KEY(idUserGroup, idStorage),
     FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup),
    FOREIGN KEY(idStorage) REFERENCES Storage(idStorage)
);

create table PermissionGroupCompute(
    idUserGroup INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,

    PRIMARY KEY(idUserGroup, idComputeInstance),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup),
    FOREIGN KEY(idComputeInstance) REFERENCES ComputeInstance(idComputeInstance)
);

create table PermissionGroupVCN(
    idUserGroup INT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL,

    PRIMARY KEY(idUserGroup, idVCN),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup),
    FOREIGN KEY(idVCN) REFERENCES VCN(idVCN)
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

    PRIMARY KEY(nameSetting)
);

create table DBConfiguration(
    idDataBase INT UNSIGNED NOT NULL,
    nameSetting VARCHAR(32) NOT NULL,
    bolleanValue BOOLEAN NOT NULL,
    decimalValue DECIMAL NOT NULL,
    stringValue VARCHAR(36) NOT NULL,

    PRIMARY KEY(idDataBase, nameSetting),
    FOREIGN KEY(idDataBase) REFERENCES MyDataBase(idDataBase),
    FOREIGN KEY(nameSetting) REFERENCES Setting(nameSetting)
);
create table MySQLSetting(
    idMySQL INT UNSIGNED NOT NULL,
    nameSetting VARCHAR(32) NOT NULL,

    PRIMARY KEY(idMySQL, nameSetting),
    FOREIGN KEY(idMySQL) REFERENCES DBTypeMySql(idDBType),
    FOREIGN KEY(nameSetting) REFERENCES Setting(nameSetting)
);


create table PostgradeSetting(
    idPostgrade INT UNSIGNED NOT NULL,
    nameSetting VARCHAR(32) NOT NULL,

    PRIMARY KEY(idPostgrade, nameSetting),
    FOREIGN KEY(idPostgrade) REFERENCES DBTypePostgrade(idDBType),
    FOREIGN KEY(nameSetting) REFERENCES Setting(nameSetting)
);

create table MYUsage(
    idComputeCPU INT UNSIGNED NOT NULL,
    idComputeMEM INT UNSIGNED NOT NULL,
    idStorage INT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL,
    idDataBase INT UNSIGNED NOT NULL,
    value FLOAT,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(idComputeCPU, idComputeMEM, idStorage, idVCN, creationDate),
    FOREIGN KEY(idComputeCPU) REFERENCES ComputeInstance(idComputeInstance),
    FOREIGN KEY(idComputeMem) REFERENCES ComputeInstance(idComputeInstance),
    FOREIGN KEY(idVCN) REFERENCES VCN(idVCN),
    FOREIGN KEY(idDataBase) REFERENCES MyDataBase(idDataBase),
    FOREIGN KEY(idStorage) REFERENCES Storage(idStorage)
);

create table StorageCost(
    idStorageCost INT UNSIGNED NOT NULL AUTO_INCREMENT,
    IOSpeed FLOAT UNSIGNED NOT NULL,
    totalCapacity FLOAT UNSIGNED NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) NOT NULL,

    PRIMARY KEY(idStorageCost),
    FOREIGN KEY(IOSpeed) REFERENCES Speed(IOSpeed),
    FOREIGN KEY(typeName) REFERENCES Type(typeName),
    FOREIGN KEY(totalCapacity) REFERENCES Size(totalCapacity)
);

Insert into Privilege(namePrivilege) VALUES
("View Payments"),
("Super Admin"),
("Edit Privilegies"),
("Edit User Groups"),
("Edit Users"),
("Edit Company");

DELIMITER //

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
END//

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
    ("Edit Company", idUserGroupPar, valuePar);
END//

DELIMITER ;


SELECT RegisterCompany("TotCloud", "Spain", "Master", "Admin", "admin@gmail.com", "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918");


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
