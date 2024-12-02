<?php
class Cpu{
    private $statusName;
    private $coreCount;
    private $cacheL1;
    private $cacheL2;
    private $cacheL3;
    private $frequency;
    private $cost;
    private $model;
    private $series;

    private $memories;

    private $images;

    public function __construct(String $model, String $series, String $statusName, int $coreCount, float $cacheL1, float $cacheL2, float $cacheL3, 
    float $frequency, float $cost, array $memories = null, array $images = null){
        $this->model = $model;
        $this->series = $series;
        $this->statusName = $statusName;
        $this->coreCount = $coreCount;
        $this->cacheL1 = $cacheL1;
        $this->cacheL2 = $cacheL2;
        $this->cacheL3 = $cacheL3;
        $this->frequency = $frequency;
        $this->cost = $cost;
        $this->memories = $memories;
        $this->images = $images;
    }

    public function getModel(): string {
        return $this->model;
    }

    public function setModel(string $model): void {
        $this->model = $model;
    }

    public function getSeries(): string {
        return $this->series;
    }

    public function setSeries(string $series): void {
        $this->series = $series;
    }

    public function getStatusName(): string {
        return $this->statusName;
    }

    public function setStatusName(string $statusName): void {
        $this->statusName = $statusName;
    }

    public function getCoreCount(): int {
        return $this->coreCount;
    }

    public function setCoreCount(int $coreCount): void {
        $this->coreCount = $coreCount;
    }

    public function getCacheL1(): float {
        return $this->cacheL1;
    }

    public function setCacheL1(float $cacheL1): void {
        $this->cacheL1 = $cacheL1;
    }

    public function getCacheL2(): float {
        return $this->cacheL2;
    }

    public function setCacheL2(float $cacheL2): void {
        $this->cacheL2 = $cacheL2;
    }

    public function getCacheL3(): float {
        return $this->cacheL3;
    }

    public function setCacheL3(float $cacheL3): void {
        $this->cacheL3 = $cacheL3;
    }

    public function getFrequency(): float {
        return $this->frequency;
    }

    public function setFrequency(float $frequency): void {
        $this->frequency = $frequency;
    }

    public function getCost(): float {
        return $this->cost;
    }

    public function setCost(float $cost): void {
        $this->cost = $cost;
    }

    public function getImages(): array {
        return $this->images;
    }

    public function setImages(array $images): void {
        $this->images = $images;
    }

    public function getMemories(): array {
        return $this->memories;
    }

    public function setMemories(array $memories): void {
        $this->memories = $memories;
    }

    public function toString():String{
        $stringMem = "Memories: ";
        foreach($this->memories as $memory){
            $stringMem = $stringMem .", " . $memory;
        }

        $stringImg = "Images: ";
        foreach($this->images as $image){
            $stringImg = $stringImg .", " . $image;
        }

        return "statusName: {$this->statusName}, " .
           "coreCount: {$this->coreCount}, " .
           "cacheL1: {$this->cacheL1}, " .
           "cacheL2: {$this->cacheL2}, " .
           "cacheL3: {$this->cacheL3}, " .
           "frequency: {$this->frequency}, " .
           "cost: {$this->cost}, " .
           "model: {$this->model}, " .
           "series: {$this->series}".
           "$stringImg, $stringMem";
    }
    
}