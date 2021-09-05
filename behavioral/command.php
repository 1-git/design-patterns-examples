<?php

namespace DesignPattern\Behavioral\Command;

interface Executable
{
    public function execute();
}

class SimpleCommand implements Executable
{
    protected $reciever;

    public function __construct(Receiver $reciever)
    {
        $this->reciever = $reciever;
    }

    public function execute()
    {
        var_dump(111);
        $this->reciever->showData();
    }
}

class NewCommand implements Executable
{
    protected $reciever;

    public function __construct(Receiver $reciever)
    {
        $this->reciever = $reciever;
    }

    public function execute()
    {
        var_dump(222);
        $this->reciever->showData();
    }
}

class Invoker
{
    protected $command;

    public function __construct(Executable $command)
    {
        $this->command = $command;
    }

    public function run()
    {
        $this->command->execute();
    }
}

class Receiver
{
    public function showData()
    {
        var_dump(333);
    }
}

$reciever = new Receiver();

$invoker = new Invoker(new SimpleCommand($reciever));
$invoker->run();

$invoker = new Invoker(new NewCommand($reciever));
$invoker->run();