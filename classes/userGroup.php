<?php

class UserGroup{
    private $id;
    private $idCompany;
    private $creationDate;
    private $name;

    public function __construct(int $idCompany, DateTime $creationDate, String $name){
        $this->idCompany = $idCompany;
        $this->creationDate = $creationDate;
        $this->name = $name;
    }

    public function getId():int{
        return $this->id;
    }
    public function getIdCompany():int{
        return $this->idCompany;
    }
    public function getCreationDate(): DateTime{
        return $this->creationDate;
    }
    public function getName(): String{
        return $this->name;
    }

    public function setId(int $id){
        $this->id = $id;
    }
}
