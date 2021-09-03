<?php

namespace DesignPattern\Behavioral\Momento;

class Originator
{
    protected $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function save(): Momento
    {
        return new Momento($this->data);
    }

    public function restore(Momento $momento)
    {
        $this->data = $momento->getData();
    }
}

class Momento
{
    protected $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function getData()
    {
        return $this->state;
    }
}

class Caretaker
{
    protected $momento;

    public function setMomento(Momento $momento)
    {
        $this->momento = $momento;
    }

    public function getMomento()
    {
        return $this->momento;
    }
}

echo '<pre>';

$originator = new Originator();
$originator->setData([1, 2, 3]);

var_dump($originator->getData());

$caretaker = new Caretaker();
$caretaker->setMomento($originator->save());

$originator->setData([4, 5, 6]);
var_dump($originator->getData());

$originator->restore($caretaker->getMomento());

var_dump($originator->getData());
