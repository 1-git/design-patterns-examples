<?php

namespace DesignPattern\Structural\Proxy;

interface Runnable {
    public function run();
}

class Example implements Runnable
{
    public function run()
    {
        return 111;
    }
}

class Proxy implements Runnable
{
    public function run()
    {
        $result = (new Example)->run();
        $this->log($result);
        return $result;
    }

    protected function log($result)
    {
    }
}

class Client
{
    public function handle()
    {
        return (new Proxy())->execute();
    }
}

$result = (new Client())->handle();
var_dump($result);
