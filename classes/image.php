<?php
class Image{
    private $idImage;
    private $statusName;
    private $cost;
    private $osName;
    private $build;

    public function __construct(int $idImage, String $statusName, float $cost, String $osName, String $build){
        $this->idImage = $idImage;
        $this->statusName = $statusName;
        $this->cost = $cost;
        $this->osName = $osName;
        $this->build = $build;
    }
    public function getIdImage():int{
        return $this->idImage;
    }
    public function getStatusName():String{
        return $this->statusName;
    }
    public function getCost():float{
        return $this->cost;
    }
    public function getOsName():String{
        return $this->osName;
    }
    public function getBuild():String{
        return $this->build;
    }
    public function setIdImage($idImage): void{
        $this->idImage = $idImage;
    }
    public function setStatusName($statusName): void{
        $this->statusName = $statusName;
    }
    public function setCost($cost): void{
        $this->cost = $cost;
    }
    public function setOsName($osName): void{
        $this->osName = $osName;
    }
    public function setBuild($build): void{
        $this->build = $build;
    }
}