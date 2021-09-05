<?php

namespace DesignPattern\Creational\Singleton;

use Exception;

class Connection {
    protected static $instance;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function __sleep()
    {
        echo 111;exit;
    }

    public function __wakeup()
    {
        throw new Exception();
    }

    public static function getInstance(): Connection
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

$r = Connection::getInstance();
var_dump($r);
