<?php

namespace DesignPattern\Creational\FactoryMethod;

interface FieldValue
{
    public function getValue();
}

class TextField implements FieldValue
{
    public function getValue()
    {
        return 111;
    }
}

class CheckboxField implements FieldValue
{
    public function getValue()
    {
        return 222;
    }
}

class FieldFactory
{
    const TEXT_TYPE = 'text';
    const CHECKBOX_TYPE = 'checkbox';

    protected static array $map = [
        self::TEXT_TYPE => TextField::class,
        self::CHECKBOX_TYPE => CheckboxField::class,
    ];

    public static function getField(string $type): FieldValue
    {
        return new self::$map[$type];
    }
}

$textField = FieldFactory::getField(FieldFactory::TEXT_TYPE);
var_dump($textField->getValue());
