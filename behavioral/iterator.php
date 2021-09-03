<?php

namespace DesignPattern\Behavioral\Iterator;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

class ClassicIterator implements Iterator
{
    protected array $collection;

    protected int $position = 0;

    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public function current()
    {
        return $this->collection[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->collection[$this->position]);
    }
}

class AggregatedIterator implements IteratorAggregate {
    protected array $collection;

    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->collection);
    }
}

$data = ['1st', '2nd', '3rd'];

$iterator = new ClassicIterator($data);
//$iterator = (new AggregatedIterator($data))->getIterator();
//$iterator = new ArrayIterator($data);


var_dump($iterator->current());
var_dump($iterator->next());
var_dump($iterator->current());
var_dump($iterator->key());
var_dump($iterator->rewind());
var_dump($iterator->key());

var_dump($iterator->next());
var_dump($iterator->key());
var_dump($iterator->valid());

var_dump($iterator->next());
var_dump($iterator->valid());
var_dump($iterator->key());

var_dump($iterator->next());
var_dump($iterator->valid());
var_dump($iterator->key());
