<?php

class DBSetting{
    private $nameSetting;
    private $statusName;

    private $mySQL;
    private $postgrade;

    public function __construct(string $nameSetting, string $statusName, bool $mySQL, bool $postgrade){
        $this->nameSetting = $nameSetting;
        $this->statusName = $statusName;
        $this->mySQL = $mySQL;
        $this->postgrade = $postgrade;
    }

    public function getNameSetting(): string{
        return $this->nameSetting;
    }

    public function getStatusName(): string{
        return $this->statusName;
    }

    public function getmySQL(): bool{
        return $this->mySQL;
    }
    public function getPostgrade(): bool{   
        return $this->postgrade;
    }
}