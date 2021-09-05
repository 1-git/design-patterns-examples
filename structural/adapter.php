<?php

namespace DesignPattern\Structural\Adapter;

interface Runnable {
    public function run();
}

class Module {
    public function execute()
    {
        var_dump(111);
    }
}

class Client {
    public function handle(Runnable $runnable)
    {
        $runnable->run();
    }
}

class NewModule implements Runnable {
    public function run()
    {
        (new Module)->execute();
    }
}

(new Client())->handle(new NewModule());
