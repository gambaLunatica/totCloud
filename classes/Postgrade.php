<?php

class Postgrade
{
    private $idDBType;
    private $statusName;
    private $cost;
    private $releaseDate;
    private $build;

    public function __construct(int $idDBType, String $statusName, float $cost, DateTime $releaseDate, String $build)
    {
        $this->idDBType = $idDBType;
        $this->statusName = $statusName;
        $this->cost = $cost;
        $this->releaseDate = $releaseDate;
        $this->build = $build;
    }

    public function getIdDBType(): int
    {
        return $this->idDBType;
    }
    public function getStatusName(): string
    {
        return $this->statusName;
    }
    public function getCost(): float
    {
        return $this->cost;
    }
    public function getReleaseDate(): DateTime
    {
        return $this->releaseDate;
    }

    public function getBuild(): string
    {
        return $this->build;
    }
}