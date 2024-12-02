<?php

class Storage
{
    private $idStorage;
    private $usedSpace;
    private $totalCapacity;
    private $IOSpeed;
    private $creationDate;
    private $typeName;
    private $nameStorage;
    private $cost;

    public function __construct(int $idStorage, float $usedSpace, float $totalCapacity, float $IOSpeed, String $typeName, String $nameStorage, float $cost, DateTime $creationDate = null)
    {
        $this->idStorage = $idStorage;
        $this->usedSpace = $usedSpace;
        $this->totalCapacity = $totalCapacity;
        $this->IOSpeed = $IOSpeed;
        $this->creationDate = $creationDate;
        $this->typeName = $typeName;
        $this->nameStorage = $nameStorage;
        $this->cost = $cost;
    }

    public function getIdStorage():int{
        return $this->idStorage;
    }
    public function getUsedSpace(): float{
        return $this->usedSpace;
    }
    public function getTotalCapacity(): float{
        return $this->totalCapacity;
    }
    public function getIOSpeed(): float{
        return $this->IOSpeed;
    }
    public function getCreationDate(): DateTime{
        return $this->creationDate;
    }
    public function getTypeName(): string{
        return $this->typeName;
    }
    public function getNameStorage(): string{
        return $this->nameStorage;
    }

    public function getCost(): float{
        return $this->cost;
    }
}