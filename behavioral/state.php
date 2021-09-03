<?php

namespace DesignPattern\Behavioral\State;

use Exception;

interface MessageInterface
{
    public function getMessage(): string;
}

class ErrorMessage implements MessageInterface
{
    public function getMessage(): string
    {
        return 'Error message';
    }
}

class InfoMessage implements MessageInterface
{
    public function getMessage(): string
    {
        return 'Info message';
    }
}

###########################################################
######## SOLUTION 1 - STATE DETECT OUTSIDE OF CLASS #######
###########################################################

class Context1
{
    protected $state;

    public function setState(string $state)
    {
        $this->state = $state;
    }

    protected MessageInterface $messageHandler;

    public function getMessage(): string
    {
        if ($this->state === 'error') {
            $messageHandler = new ErrorMessage();
        } elseif ($this->state === 'info') {
            $messageHandler = new InfoMessage();
        } else {
            throw new Exception();
        }

        return $messageHandler->getMessage();
    }
}

$context = (new Context1());

$context->setState('error');
$message = $context->getMessage();
var_dump($message);

$context->setState('info');
$message = $context->getMessage();
var_dump($message);

###########################################################
######## SOLUTION 2 - STATE DETECT IN SEPARATE FILE #######
###########################################################

class Context2
{
    protected $state;

    public function setState(string $state)
    {
        $this->state = $state;
    }

    public function getMessage(): string
    {
        $handler = (new MessageDecisionMaker())->getHandler($this->state);
        return $handler->getMessage();
    }
}

class MessageDecisionMaker
{
    public function getHandler(string $state): MessageInterface
    {
        if ($state === 'error') {
            $handler = new ErrorMessage();
        } elseif ($state === 'info') {
            $handler = new InfoMessage();
        } else {
            throw new Exception();
        }

        return $handler;
    }
}

$context = (new Context2());

$context->setState('error');
$message = $context->getMessage();
var_dump($message);

$context->setState('info');
$message = $context->getMessage();
var_dump($message);