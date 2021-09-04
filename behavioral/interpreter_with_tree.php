<?php


namespace DesignPattern\Behavioral\Interpreter;

use DesignPattern\Behavioral\Command\ClassicIterator;
use Exception;

interface Expression
{
    public function interpret(array $values): int;
}

class TerminalExpression implements Expression
{
    protected string $name;

    public function getVariableName(): string
    {
        return $this->name;
    }

    public function setVariableName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function interpret(array $values): int
    {
        return (integer)$values[$this->getVariableName()];
    }
}

abstract class NonTerminalExpression implements Expression
{
    protected Expression $left;

    protected TerminalExpression $right;

    public function getLeft(): Expression
    {
        return $this->left;
    }

    public function setLeft(Expression $left): self
    {
        $this->left = $left;
        return $this;
    }

    public function getRight(): TerminalExpression
    {
        return $this->right;
    }

    public function setRight(TerminalExpression $right): self
    {
        $this->right = $right;
        return $this;
    }

    abstract public function interpret(array $values): int;
}

class PlusExpression extends NonTerminalExpression
{
    public function interpret(array $values): int
    {
        return $this->getLeft()->interpret($values) + $this->getRight()->interpret($values);
    }
}

class MinusExpression extends NonTerminalExpression
{
    public function interpret(array $values): int
    {
        return $this->getLeft()->interpret($values) - $this->getRight()->interpret($values);
    }
}

class Client
{
    public function getExpression(string $token): Expression
    {
        switch ($token) {
            case '-':
                $expression = new MinusExpression();
                break;
            case '+':
                $expression = new PlusExpression();
                break;
            default:
                $expression = new TerminalExpression();
        }

        return $expression;
    }

    public function parse(string $data): Expression
    {
        $leftBase = null;
        $nonTerminalLast = null;
        $list = explode(' ', $data);
        foreach ($list as $token) {
            $expression = $this->getExpression($token);
            if ($expression instanceof TerminalExpression) {
                /** @var TerminalExpression $expression */
                $expression->setVariableName($token);

                if ($leftBase === null) {
                    $leftBase = $expression;
                } else {
                    $nonTerminalLast
                        ->setLeft($leftBase)
                        ->setRight($expression);
                    $leftBase = $nonTerminalLast;
                }
            } else {
                /** @var NonTerminalExpression $nonTerminalLast */
                $nonTerminalLast = $expression;
            }
        }

        return $leftBase;
    }

    public function handle(string $template, array $values)
    {
        $baseExpression = $this->parse($template);
        return $baseExpression->interpret($values);
    }
}

$template = "a + b + c + d - e + f";
$values = ['a' => 5, 'b' => 10, 'c' => 11, 'd' => 21, 'e' => 30, 'f' => 45];
$result = (new Client())->handle($template, $values);
var_dump($result);
