<?php

namespace DesignPattern\Creational\Prototype;

use StdClass;

class Auto {
    public $engine;
    public $door;
    public $radio;

    public function __clone()
    {
        $this->engine = clone $this->engine;
        $this->door = clone $this->door;
        $this->radio = clone $this->radio;
    }
}

$auto = new Auto();
$auto->engine = new StdClass;
$auto->door = new StdClass;
$auto->radio = new StdClass;

$auto2 = clone $auto;

var_dump($auto);
var_dump($auto2);
