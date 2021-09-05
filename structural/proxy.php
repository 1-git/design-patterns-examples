<?php

namespace DesignPattern\Behavioral\Proxy;

class Example
{
    public function run()
    {
        return 111;
    }
}

class Proxy
{
    public function execute()
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
