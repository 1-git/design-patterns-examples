<?php

namespace DesignPattern\Structural\Decorator;

class Example
{
    public function run()
    {
        return 111;
    }
}

class Decorator
{
    public function execute()
    {
        $result = (new Example)->run();
        $result = $this->paginate($result);
        return $result;
    }

    protected function paginate($result)
    {
        //Additional logic
        return $result;
    }
}

class Client
{
    public function handle()
    {
        return (new Decorator())->execute();
    }
}

$result = (new Client())->handle();
var_dump($result);
