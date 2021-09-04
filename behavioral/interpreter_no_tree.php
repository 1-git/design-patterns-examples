<?php

namespace DesignPattern\Behavioral\Interpreter;

use DesignPattern\Behavioral\Command\ClassicIterator;
use Exception;

###############################################
######### Class for call in interpreter #######
###############################################

class MainClassA
{
    public function methodA()
    {
        return __CLASS__ . ' - ' . __METHOD__;
    }

    public function methodB()
    {
        return __CLASS__ . ' - ' . __METHOD__;
    }
}

class MainClassB
{
    public function methodC()
    {
        return __CLASS__ . ' - ' . __METHOD__;
    }

    public function methodD()
    {
        return __CLASS__ . ' - ' . __METHOD__;
    }
}

###############################################
################## Main code ##################
###############################################

abstract class Expression
{
    abstract public function interprete();
}

abstract class TerminalExpression extends Expression
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function interprete()
    {
        return $this->name;
    }
}

abstract class NonTerminalExpression extends Expression
{
    protected $leftValue;
    protected $rightValue;

    public function __construct($leftValue, $rightValue)
    {
        $this->leftValue = $leftValue;
        $this->rightValue = $rightValue;
    }
}

class ClassValue extends TerminalExpression
{
}

class MethodValue extends TerminalExpression
{
}

class Devider extends NonTerminalExpression
{
    public $identifier = ':';

    public function interprete()
    {
        $classValue = $this->leftValue->interprete();
        $methodValue = $this->rightValue->interprete();

        if (!method_exists($classValue, $methodValue)){
            throw new Exception('Method not exists');
        }

        return (new $classValue)->$methodValue();
    }
}

class Interpreter
{
    public function getValue(string $expression)
    {
        $list = explode(':', $expression);
        $class = new ClassValue($list[0]);
        $method = new MethodValue($list[1]);
        $expression = new Devider($class, $method);
        $result = $expression->interprete();

        return $result;
    }
}

$expression = __NAMESPACE__ . '\MainClassA:methodB';
$value = (new Interpreter())->getValue($expression);
var_dump($value);
