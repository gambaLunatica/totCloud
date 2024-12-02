<?php

class Memory{
    private $idMemory;
    private $statusName;
    private $totalCapacity;
    private $IOSpeed;
    private $generation;
    private $cost;

    public function __construct($idMemory, $statusName, $totalCapacity, $IOSpeed, $generation, $cost){
        $this->idMemory = $idMemory;
        $this->statusName = $statusName;
        $this->totalCapacity = $totalCapacity;
        $this->IOSpeed = $IOSpeed;
        $this->generation = $generation;
        $this->cost = $cost;
    }

    public function getIdMemory():int{
        return $this->idMemory;
    }
    public function getStatusName():String{
        return $this->statusName;
    }
    public function getTotalCapacity():float{
        return $this->totalCapacity;
    }
    public function getIOSpeed():float{
        return $this->IOSpeed;
    }
    public function getGeneration():String{
        return $this->generation;
    }
    public function getCost():float{
        return $this->cost;
    }
    
}