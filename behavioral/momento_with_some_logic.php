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
    protected $date;
    protected $state;

    public function __construct($state)
    {
        $this->date = date('Y-m-d H:i:s');
        $this->state = $state;
    }

    public function getInfo()
    {
        return $this->date . '-' . json_encode($this->state);
    }

    public function getData()
    {
        return $this->state;
    }
}

class Caretaker
{
    protected Originator $originator;

    protected $momentos = [];

    public function __construct(Originator $originator)
    {
        $this->originator = $originator;
    }

    public function backup()
    {
        $this->momentos[] = $this->originator->save();
    }

    public function undo()
    {
        $momento = array_pop($this->momentos);
        $this->originator->restore($momento);
    }

    public function getList()
    {
        $names = [];
        foreach ($this->momentos as $momento) {
            $names[] = $momento->getInfo();
        }
        return $names;
    }
}

echo '<pre>';

$originator = new Originator();
$caretaker = new Caretaker($originator);

$originator->setData([1, 2, 3]);
$caretaker->backup();

$originator->setData([4, 5, 6]);
$caretaker->backup();
$originator->setData([7, 8, 9]);

var_dump($originator->getData());
var_dump($caretaker->getList());
$caretaker->undo();
var_dump($originator->getData());
var_dump($caretaker->getList());

