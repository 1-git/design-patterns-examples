<?php

namespace DesignPattern\Behavioral\ChainOfResponsibility;

interface BaseHandler
{
    public function setNext(BaseHandler $handler): BaseHandler;

    public function handle(string $data): ?string;
}

abstract class HandlerAbstract implements BaseHandler
{
    protected $next;

    public function setNext(BaseHandler $handler): BaseHandler
    {
        $this->next = $handler;
        return $handler;
    }

    public function handle(string $data): ?string
    {
        if ($this->next) {
            return $this->next->handle($data);
        }

        return null;
    }
}

class LoggerHandler extends HandlerAbstract
{
    public function handle(string $data): ?string
    {
        if ($data%3 == 0) {
            var_dump(__CLASS__);
        }

        return parent::handle($data);
    }
}

class NotificationHandler extends HandlerAbstract
{
    public function handle(string $data): ?string
    {
        if ($data%5 == 0) {
            var_dump(__CLASS__);
        }

        return parent::handle($data);
    }
}

class SqlHandler extends HandlerAbstract
{
    public function handle(string $data): ?string
    {
        if ($data%10 == 0) {
            var_dump(__CLASS__);
        }

        return parent::handle($data);
    }
}


$logger = new LoggerHandler();
$notificator = new NotificationHandler();
$sql = new SqlHandler();

$logger->setNext($notificator)->setNext($sql);

$data = 3;
$logger->handle($data);
var_dump('------------');
$data = 5;
$logger->handle($data);
var_dump('------------');
$data = 15;
$logger->handle($data);
var_dump('------------');
$data = 30;
$logger->handle($data);
