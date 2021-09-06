<?php

namespace DesignPattern\Creational\FactoryMethod;

class TextField {
}

class CheckboxField {
}

class FieldFactory {
    const TEXT_TYPE = 'text';
    const CHECKBOX_TYPE = 'checkbox';

    protected array $map = [
        self::TEXT_TYPE => TextField::class,
        self::CHECKBOX_TYPE => CheckboxField::class,
    ];
    public function getField(string $type)
    {
        return new $this->map[$type];
    }
}

$factory = new FieldFactory();
$textField = $factory->getField(FieldFactory::TEXT_TYPE);
var_dump($textField);
