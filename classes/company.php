<?php
class Company{
    private $nameRegion;
    private $name;

    public function __construct(String $nameRegion, String $name){
        $this->nameRegion = $nameRegion;
        $this->name = $name;
    }

    public function getNameRegion(): String{
        return $this->nameRegion;
    }
    public function getName(): String{
        return $this->name;
    }
}