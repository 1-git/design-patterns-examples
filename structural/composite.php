<?php

namespace DesignPattern\Structural\Composite;

abstract class Component
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function display();
}

class Leaf extends Component
{
    public function display()
    {
        return $this->name;
    }
}

class Composite extends Component
{
    /** @var array Component[] */
    protected array $children = [];

    public function add(Component $component)
    {
        $this->children[$component->name] = $component;
    }

    public function remove(Component $component)
    {
        unset($this->children[$component->name]);
    }

    public function display()
    {
        $children = [];
        foreach ($this->children as $child) {
            $children[] = $child->display();
        }

        return $children;
    }
}

$root = new Composite('root');
$root->add(new Leaf('Leaf A'));
$root->add(new Leaf('Leaf B'));

$composite = new Composite('Composite A');
$composite->add(new Leaf('Composite AA'));
$composite->add(new Leaf('Composite AB'));

$root->add($composite);

$leaf = new Leaf('Leaf C');
$root->add($leaf);
$root->remove($leaf);

var_dump($root->display());
