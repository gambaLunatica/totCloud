CREATE DATABASE totCloud;

create table Privilege(
    idPrivilege INT UNSIGNED NOT NULL AUTO_INCREMENT,
    namePrivilege VARCHAR(32) NOT NULL,

    PRIMARY KEY(idPrivilege)
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
    idCompany INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(32) NOT NULL,
    nameRegion VARCHAR(32) NOT NULL,
    nameCompany VARCHAR(32) NOT NULL,

    PRIMARY KEY(idCompany),
    FOREIGN KEY(nameRegion) REFERENCES Region(nameRegion),
    FOREIGN KEY(name) REFERENCES MyUser(name)
);
create table PaymentMethod(
    nameMethod VARCHAR(32) NOT NULL,

    PRIMARY KEY(nameMethod)
);
create table VCN(
    cidr TINYINT UNSIGNED NOT NULL,
    idVCN INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idCompany INT UNSIGNED NOT NULL,
    privateIP BINARY(4) NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameRegion VARCHAR(32) NOT NULL,
    name VARCHAR(32) NOT NULL,

    PRIMARY KEY(idVCN),
    FOREIGN KEY(idCompany) REFERENCES Company(idCompany),
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

    PRIMARY KEY(idSubnet),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet)
);
create table Payment(
    idPayment INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idCompany INT UNSIGNED NOT NULL,
    nameMethod VARCHAR(32) NOT NULL,
    quantity FLOAT NOT NULL,
    paymentDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(idPayment),
    FOREIGN KEY(idCompany) REFERENCES Company(idCompany),
    FOREIGN KEY(nameMethod) REFERENCES PaymentMethod(nameMethod)
);
create table UserGroup(
    idUserGroup INT UNSIGNED NOT NULL AUTO_INCREMENT,
    idCompany INT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameUserGroup VARCHAR(32) NOT NULL,

    PRIMARY KEY(idUserGroup),
    FOREIGN KEY(idCompany) REFERENCES Company(idCompany)
);
create table PrivilegeConfiguration(
    idUserGroup INT UNSIGNED NOT NULL,
    idPrivilege INT UNSIGNED NOT NULL,
    value BIT NOT NULL,

    PRIMARY KEY (idUserGroup, idPrivilege),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup),
    FOREIGN KEY(idPrivilege) REFERENCES Privilege (idPrivilege)
);

create table MyUser(
    name VARCHAR(32) NOT NULL,
    email VARCHAR(64) NOT NULL,
    password VARCHAR(256) NOT NULL,
    idUserGroup INT UNSIGNED NOT NULL AUTO_INCREMENT,

    PRIMARY KEY(name),
    FOREIGN KEY(idUserGroup) REFERENCES UserGroup(idUserGroup)
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
    cost FLOAT UNSIGNED NOT NULL,
    typeName VARCHAR(16) NOT NULL,
    generation VARCHAR(32) NOT NULL,

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
    idCompany INT UNSIGNED NOT NULL,
    idMemory INT UNSIGNED NOT NULL,
    idImage INT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    model VARCHAR(32) NOT NULL,
    name VARCHAR(32) NOT NULL,
    sshKey BLOB(512) NULL,

    PRIMARY KEY(idComputeInstance),
    FOREIGN KEY(idSubnet) REFERENCES Subnet(idSubnet),
    FOREIGN KEY(idCompany) REFERENCES Company(idCompany),
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
    idCompany INT UNSIGNED NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    usedSpace FLOAT UNSIGNED NOT NULL,
    totalCapacity FLOAT UNSIGNED NOT NULL,
    IOSpeed FLOAT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    typeName VARCHAR(16) NOT NULL,
    name VARCHAR(32) NOT NULL,

    PRIMARY KEY(idStorage),
    FOREIGN KEY(idCompany) REFERENCES Company(idCompany),
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
    idCompany INT UNSIGNED NOT NULL,
    idSubnet INT UNSIGNED NOT NULL,
    idComputeInstance INT UNSIGNED NOT NULL,
    idDBType INT UNSIGNED NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nameDataBase VARCHAR(32) NOT NULL,
    description VARCHAR(512) NULL,

    PRIMARY KEY(idDataBase),
    FOREIGN KEY(idCompany) REFERENCES Company(idCompany),
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