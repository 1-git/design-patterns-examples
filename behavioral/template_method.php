<?php

namespace DesignPattern\Behavioral\TemplateMethod;

abstract class BaseHandler {
    abstract protected function sendMessage($message);
    abstract protected function logData($message);

    public function handle($message)
    {
        $this->sendMessage($message);
        $this->logData($message);
        $this->sentToConsoleMessage($message);
    }

    protected function sentToConsoleMessage($message)
    {
        var_dump('Message was sent to console: ' . $message);
    }
}

class ConcreteHandler extends BaseHandler
{
    protected function sendMessage($message)
    {
        var_dump('Message was sent: ' . $message);
    }

    protected function logData($message)
    {
        var_dump('Message was logged: ' . $message);
    }
}

$message = 'Test';
(new ConcreteHandler())->handle($message);