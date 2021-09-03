<?php

namespace Patterns;

interface Mediator
{
    public function notify(object $sender, string $event): void;
}

class ConcreteMediator implements Mediator
{
    protected $component1;
    protected $component2;

    public function __construct(Component1 $component1, Component2 $component2)
    {
        $this->component1 = $component1;
        $this->component1->setMediator($component1);
        $this->component2 = $component2;
        $this->component2->setMediator($component2);
    }

    public function notify(object $sender, string $event): void
    {
        if ($event == 'A') {
            $this->component2->doC();
        }
        if ($event == 'D') {
            $this->component1->doB();
            $this->component2->doC();
        }
    }
}

class BaseComponent
{
    protected $mediator;

    public function setMediator(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }
}

class Component1 extends BaseComponent
{
    public function doA()
    {
        $this->mediator->notify($this, 'A');
    }

    public function doB()
    {
        $this->mediator->notify($this, 'B');
    }
}

class Component2 extends BaseComponent
{
    public function doC()
    {
        $this->mediator->notify($this, 'C');
    }

    public function doD()
    {
        $this->mediator->notify($this, 'D');
    }
}

$component1 = new Component1();
$component2 = new Component2();
$mediator = new ConcreteMediator($component1, $component2);

$component1->doA();
$component2->doD();
