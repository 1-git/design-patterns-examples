<?php

namespace DesignPattern\Behavioral\Visitor;

interface Visitor
{
    public function visitElementA(ConcreteElementA $elementA);

    public function visitElementB(ConcreteElementB $elementB);
}

class ConcreteVisitor1 implements Visitor
{
    public function visitElementA(ConcreteElementA $elementA)
    {
        $elementA->operationA();
    }

    public function visitElementB(ConcreteElementB $elementB)
    {
        $elementB->operationB();
    }
}

class ConcreteVisitor2 implements Visitor
{
    public function visitElementA(ConcreteElementA $elementA)
    {
        $elementA->operationA();
    }

    public function visitElementB(ConcreteElementB $elementB)
    {
        $elementB->operationB();
    }
}

interface Element
{
    public function accept(Visitor $visitor);
}

class ConcreteElementA implements Element
{
    public function accept(Visitor $visitor)
    {
        $visitor->visitElementA($this);
    }

    public function operationA()
    {
        var_dump('Operation A');
    }
}

class ConcreteElementB implements Element
{
    public function accept(Visitor $visitor)
    {
        $visitor->visitElementB($this);
    }

    public function operationB()
    {
        var_dump('Operation B');
    }
}

$element = new ConcreteElementA();
$visitor = new ConcreteVisitor1();
$element->accept($visitor);

$element = new ConcreteElementB();
$visitor = new ConcreteVisitor2();
$element->accept($visitor);
