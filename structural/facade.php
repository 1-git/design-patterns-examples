<?php

namespace DesignPattern\Structural\Facade;

class ModuleA
{
    public function actionA()
    {
    }
}

class ModuleB
{
    public function execute()
    {
    }
}


class ModuleC
{
    public function run()
    {
    }
}

class Client {
    public function handle()
    {
        return (new Facade())->getData();
    }
}

class Facade {
    public function getData()
    {
        (new ModuleA())->actionA();
        (new ModuleB())->execute();
        (new ModuleC())->run();
    }
}

(new Client())->handle();
