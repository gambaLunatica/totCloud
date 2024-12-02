<?php
class Mask{
    private $cost;
    private $cidr;

    public function __construct(float $cost, int $cidr){
        $this->cost = $cost;
        $this->cidr = $cidr;
    }
    public function getCost(): float{
        return $this->cost;
    }
    public function getCidr(): int{
        return $this->cidr;
    }

}