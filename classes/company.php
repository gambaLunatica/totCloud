<?php
class Company{
    private $id;
    private $nameRegion;
    private $name;

    public function __construct(String $nameRegion, String $name){
        $this->nameRegion = $nameRegion;
        $this->name = $name;
    }

    public function getId():int{
        return $this->id;
    }

    public function getNameRegion(): String{
        return $this->nameRegion;
    }
    public function getName(): String{
        return $this->name;
    }

    public function setId(int $id){
        $this->id = $id;
    }
}