create table TotColud;

create table Privilege(
    idPrivilege INT UNSIGNED NOT NULL AUTO_INCREMENT,
    namePrivilege VARCHAR(32) NOT NULL,

    PRIMARY KEY(idPrivilegies)
);

create table Status(
    statusName VARCHAR(16) NOT NULL,
    PRIMARY KEY(statusName)
)

create table Region(
    nameRegion VARCHAR(32) NOT NULL,

    PRIMARY KEY(nameRegion)
);

create table Mask(
    cidr TINYINT UNSIGNED NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,

    PRIMARY KEY (cdir)
);

create table Company(
    idCompany INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameRegion VARCHAR(32) NOT NULL,
    nameCompany VARCHAR(32) NOT NULL,

    PRIMARY KEY(idCompany),
    //FK 
);

create table VCN(
    cidr TINYINT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idCompany INT UNSIGNED NOT NULL,
    privateIP BINARY(4) NOT NULL,
    creationDate DATETIME NOT NULL CURRENT_TIMESTAMP,
    nameRegion VARCHAR(32) NOT NULL,
    name VARCHAR(32) NOT NULL,

    PRIMARY KEY(idVCN),
    //FK
);

create table PaymentMethod(
    nameMethod VARCHAR(32) NOT NULL,

    PRIMARY KEY(nameMethod)
);

create table Subnet(
    cidr TINYINT UNSIGNED NOT NULL,
    idSubnet INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idVCN INT UNSIGNED NOT NULL,
    privateIP BINARY(4) NOT NULL,
    name VARCHAR(32) NOT NULL,

    PRIMARY KEY(idSubnet),
    //FK
);

create table Public(
    idSubnet INT UNSIGNED NOT NULL AUTO_INCREMENT,
    privateIP BINARY(4) NOT NULL UNIQUE,

    PRIMARY KEY(idSubnet),
    //FK
);

create table Payment(
    idPayment INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idCompany INT UNSIGNED NOT NULL,
    idPaymentMethod INT UNSIGNED NOT NULL,
    quantity FLOAT NOT NULL,
    paymentDate DATETIME NOT NULL CURRENT_TIMESTAMP,

    PRIMARY KEY(idPayment)
    //FK
);

create table UserGroup(
    idUserGroup INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idCompany INT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL CURRENT_TIMESTAMP,
    nameUserGroup VARCHAR(32) NOT NULL,

    PRIMARY KEY(idUserGroup),
    //FK Constraint
);

create table PrivilegeConfiguration(
    idUserGroup INT UNSIGNED NOT NULL,
    idPrivilege INT UNSIGNED NOT NULL,

    PRIMARY KEY (idUserGroup, idPrivilege),
    //FK Constraint
);

create table Generation(
    generation VARCHAR(32) NOT NULL,
    PRIMARY KEY(generation)
)

create table Speed(
    IOSpeed FLOAT UNSIGNED NOT NULL,
    PRIMARY KEY (IOSpeed)
);

create table Type(
    typeName VARCHAR(16) UNSIGNED NOT NULL,
    PRIMARY KEY(typeName)
);

create table Size(
    totalCapacity FLOAT UNSIGNED NOT NULL,
    PRIMARY KEY(totalCapacity)
)

create table Memory(
    idMemory INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    totalCapacity FLOAT UNSIGNED NOT NULL,
    IOSpeed FLOAT UNSIGNED NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) UNSIGNED NOT NULL,
    generation VARCHAR(32) NOT NULL,

    PRIMARY KEY (idMemory),
    //FK

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
    //FK
);

create table CompatibilityMemoryCPU(
    model VARCHAR(32) NOT NULL,
    idMemory INT UNSIGNED NOT NULL,

    PRIMARY KEY(model, idMemory),
    //FK
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
    //FK
);

create table ComputeInstance(
    idComputeInstance INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idSubnet INT UNSIGNED NOT NULL,
    idCompany INT UNSIGNED NOT NULL,
    idMemory INT UNSIGNED NOT NULL,
    idImage INT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL CURRENT_TIMESTAMP,
    model VARCHAR(32) NOT NULL,
    name VARCHAR(32) NOT NULL,
    sshKey BINARY(512) NULL,

    PRIMARY KEY(idComputeInstance),

    /FK
);

create table CompatibilityCPUImage(
    model VARCHAR(32) NOT NULL,
    idImage INT UNSIGNED NOT NULL,

    PRIMARY KEY(model, idImage),

    //FK
);



create table Storage(
    idStorage INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idCompany INT UNSIGNED NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    usedSpace FLOAT UNSIGNED NOT NULL,
    totalCapacity FLOAT UNSIGNED NOT NULL,
    IOSpeed FLOAT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL CURRENT_TIMESTAMP,
    typeName VARCHAR(16) UNSIGNED NOT NULL,
    name VARCHAR(32) NOT NULL,

    PRIMARY KEY(idStorage),
    //FK

);

create table CompatibilitySpeedType(
    IOSpeed FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) UNSIGNED NOT NULL,

    PRIMARY KEY(IOSpeed, typeName),
    //FK
);

create table CompatibilityTypeSize(
    totalCapacity FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) UNSIGNED NOT NULL,

    PRIMARY KEY(totalCapacity, typeName),
    //FK
);

create table DBTypePostgrade(
    idDBType INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    cost FLOAT NOT NULL,
    releaseDate DATE NOT NULL,
    build VARCHAR(32),

    PRIMARY KEY(idDBType),
    //FK
);

create table DBTypeMySql(
    idDBType INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(16) NOT NULL,
    cost FLOAT NOT NULL,
    releaseDate DATE NOT NULL,
    version VARCHAR(8),

    PRIMARY KEY(idDBType),
    //FK
);

create table MyDataBase(
    idDataBase INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idCompany INT UNSIGNED NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    idDBType INT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL CURRENT_TIMESTAMP,
    nameDataBase VARCHAR(32) NOT NULL,
    description VARCHAR(512) NULL,

    PRIMARY KEY(idDataBase),
    //FK

);

create table MyTable(
    idTable INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nameTable VARCHAR(32) NOT NULL,
    idDataBase INT UNSIGNED NOT NULL,

    PRIMARY KEY(idTable),
    //FK
)

create table PermissionGroupDB(
    idUserGroup INT UNSIGNED NOT NULL,
    idDataBase INT UNSIGNED NOT NULL,

    PRIMARY KEY(idUserGroup, idDataBase),
    //FK
);

create table PermissionGroupStorage(
    idUserGroup INT UNSIGNED NOT NULL,
    idStorage INT UNSIGNED NOT NULL,

    PRIMARY KEY(idUserGroup, idStorage),
    //FK
);

create table PermissionGroupCompute(
    idUserGroup INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,

    PRIMARY KEY(idUserGroup, idComputeInstance),
    //FK
);

create table PermissionGroupVCN(
    idUserGroup INT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL,

    PRIMARY KEY(idUserGroup, idVCN),
    //FK
);

create table Instruction(
    idInstruction INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idTable INT UNSIGNED NOT NULL,
    nameInstruction VARCHAR(1024) NOT NULL,
    inputDate DATETIME NOT NULL CURRENT_TIMESTAMP,

    PRIMARY KEY(idInstruction),
    //FK
);

create table MySQLSetting(
    idMySQL INT UNSIGNED NOT NULL,
    idSetting INT UNSIGNED NOT NULL,

    PRIMARY KEY(idMySQL, idSetting),
    //FK
);

create table PostgradeSetting(
    idPostgrade INT UNSIGNED NOT NULL,
    idSetting INT UNSIGNED NOT NULL,

    PRIMARY KEY(idPostgrade, idSetting),
    //FK
);

create table Usage(
    idComputeCPU INT UNSIGNED NOT NULL,
    idComputeMEM INT UNSIGNED NOT NULL,
    idStorage INT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL,
    value FLOAT,
    creationDate DATETIME NOT NULL CURRENT_TIMESTAMP,

    PRIMARY KEY(idComputeCPU, idComputeMEM, idStorage, idVCN, creationDate),
    //FK
);

create table StorageCost(
    idStorageCost INT UNSIGNED NOT NULL AUTO_INCREMENT,
    IOSpeed FLOAT UNSIGNED NOT NULL,
    totalCapacity FLOAT UNSIGNED NOT NULL,
    cost FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) UNSIGNED NOT NULL,

    PRIMARY KEY(idStorageCost),
    //FK
);