<?php

class Setting
{
    private $nameSetting;
    private $statusName;

    private $idDBTypeMySQL;
    private $idDBTypePostgrade;

    private $booleanValue;
    private $decimalValue;
    private $stringValue;

    public function __construct(string $nameSetting, string $statusName, bool $idDBTypeMySQL=null, bool $idDBTypePostgrade=null, bool $booleanValue = null, float $decimalValue = null, string $stringValue = null)
    {
        $this->nameSetting = $nameSetting;
        $this->statusName = $statusName;
        $this->idDBTypeMySQL = $idDBTypeMySQL;
        $this->idDBTypePostgrade = $idDBTypePostgrade;
        $this->booleanValue = $booleanValue;
        $this->decimalValue = $decimalValue;
        $this->stringValue = $stringValue;
    }

    public function getNameSetting(): string
    {
        return $this->nameSetting;
    }

    public function getStatusName(): string
    {
        return $this->statusName;
    }

    public function getIdDBTypeMySQL(): bool|null
    {
        return $this->idDBTypeMySQL;
    }
    public function getIdDBTypePostgrade(): bool|null
    {
        return $this->idDBTypePostgrade;
    }
    public function getBooleanValue(): bool|null
    {
        return $this->booleanValue;
    }
    public function getDecimalValue(): float|null
    {
        return $this->decimalValue;
    }
    public function getStringValue(): string|null
    {
        return $this->stringValue;
    }

}