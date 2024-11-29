<?php

class UserGroup{
    private $id;
    private $nameCompany;
    private $creationDate;
    private $name;

    public function __construct(String $nameCompany, String $name){
        $this->nameCompany = $nameCompany;
        $this->name = $name;
    }

    public function getId():int{
        return $this->id;
    }
    public function getNameCompany():String{
        return $this->nameCompany;
    }
    public function getCreationDate(): DateTime{
        return $this->creationDate;
    }

    public function setCreationDate(DateTime $creationDate):void{
        $this->creationDate = $creationDate;
    }

    public function getName(): String{
        return $this->name;
    }

    public function setId(int $id):void{
        $this->id = $id;
    }
}
