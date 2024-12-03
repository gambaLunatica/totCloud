<?php

class Storage
{
    private $totalCapacity;
    private $IOSpeed;
    private $typeName;
    private $nameStorage;
    private $cost;

    private $statusName;

    public function __construct(float $totalCapacity, float $IOSpeed, String $typeName, String $nameStorage, float $cost, string $statusName)
    {
        $this->totalCapacity = $totalCapacity;
        $this->IOSpeed = $IOSpeed;
        $this->typeName = $typeName;
        $this->nameStorage = $nameStorage;
        $this->cost = $cost;
        $this->statusName = $statusName;
    }

    public function getTotalCapacity(): float{
        return $this->totalCapacity;
    }
    public function getIOSpeed(): float{
        return $this->IOSpeed;
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

    public function getStatusName():String{
        return $this->statusName;
    }
}