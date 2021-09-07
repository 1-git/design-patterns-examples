<?php

namespace DesignPattern\Creational\Builder;

class Director
{
    protected Builder $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function construct()
    {
        $this->builder->buildBasement();
        $this->builder->buildWalls();
        $this->builder->buildRoof();
    }
}

abstract class Builder
{
    protected House $house;

    public function __construct(House $house)
    {
        $this->house = $house;
    }

    public function getResult(): House
    {
        return $this->house;
    }

    abstract public function buildBasement();

    abstract public function buildWalls();

    abstract public function buildRoof();
}

class SkyscraperBuilder extends Builder
{
    public function buildBasement()
    {
        $this->house->add('Basement');
    }

    public function buildWalls()
    {
        $this->house->add('100 levels');
    }

    public function buildRoof()
    {
        $this->house->add('Roof with swimming pool');
    }
}

class VillageHouseBuilder extends Builder
{
    public function buildBasement()
    {
        $this->house->add('Basement');
    }

    public function buildWalls()
    {
        $this->house->add('1 level');
    }

    public function buildRoof()
    {
        $this->house->add('Roof');
    }
}

class House
{
    protected array $parts = [];

    public function add($part)
    {
        $this->parts[] = $part;
    }
}

$builder = new SkyscraperBuilder(new House());
$director = new Director($builder);
$director->construct();
$house = $builder->getResult();

var_dump($house);

$builder = new VillageHouseBuilder(new House());
$director = new Director($builder);
$director->construct();
$house = $builder->getResult();

var_dump($house);
