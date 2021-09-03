<?php

namespace Patterns;

interface MediatorInterface
{
    public function notify(AbstractComponent $component, string $message): void;
}

class Mediator implements MediatorInterface
{
    protected $component1;
    protected $component2;
    protected $component3;

    public function __construct(Component1 $component1, Component2 $component2, Component3 $component3)
    {
        $this->component1 = $component1;
        $this->component1->setMediator($this);
        $this->component2 = $component2;
        $this->component2->setMediator($this);
        $this->component3 = $component3;
        $this->component3->setMediator($this);
    }

    public function notify(AbstractComponent $component, string $message): void
    {
        if ($component instanceof Component1) {
            $this->component2->startSubProcess($message);
        } elseif ($component instanceof Component2) {
            $this->component3->logProcess($message);
        }
    }
}

abstract class AbstractComponent
{
    protected $mediator;

    public function setMediator($mediator)
    {
        $this->mediator = $mediator;
    }
}

class Component1 extends AbstractComponent
{
    public function initAction()
    {
        $data = '1';
        var_dump('Started' . $data);
        $this->mediator->notify($this, $data);
    }
}

class Component2 extends AbstractComponent
{
    public function startSubProcess(string $message)
    {
        var_dump($message);
        $this->mediator->notify($this, $message);
    }
}

class Component3 extends AbstractComponent
{
    public function logProcess(string $message)
    {
        var_dump($message);
    }
}

$component1 = new Component1();
$component2 = new Component2();
$component3 = new Component3();
$mediator = new Mediator($component1, $component2, $component3);


$component1->initAction();
