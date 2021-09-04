<?php

namespace DesignPattern\Behavioral\Observer;

class Notificator
{
    protected array $listeners = [];

    public function attach(ListenerInterface $listener)
    {
        $this->listeners[$listener::class] = $listener;
    }

    public function detach(ListenerInterface $listener)
    {
        unset($this->listeners[$listener::class]);
    }

    public function notify(array $data)
    {
        foreach ($this->listeners as $listener) {
            $listener->handle($data);
        }
    }
}

interface ListenerInterface
{
    public function handle(array $data);
}

class ConcreteListenerA implements ListenerInterface
{
    public function handle(array $data)
    {
        if (count($data) <= 1) {
            var_dump('Listener A');
        }
    }
}

class ConcreteListenerB implements ListenerInterface
{
    public function handle(array $data)
    {
        if (count($data) > 1) {
            var_dump('Listener B');
        }
    }
}

$notificator = new Notificator();

$listenerA = new ConcreteListenerA();
$listenerB = new ConcreteListenerB();

$notificator->attach($listenerA);
$notificator->attach($listenerB);

$data = ['111'];
$notificator->notify($data);

$data = ['111', '222'];
$notificator->notify($data);

$notificator->detach($listenerB);
$notificator->notify($data);
