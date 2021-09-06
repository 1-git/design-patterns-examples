<?php

namespace DesignPattern\Creational\AbstractFactory;

class Button
{
    public function getWindowsButton()
    {
        return 'Windows Button';
    }

    public function getLinuxButton()
    {
        return 'Linux Button';
    }
}

class Description
{
    public function getWindowsDescription()
    {
        return 'Windows Description';
    }

    public function getLinuxDescription()
    {
        return 'Linux Description';
    }
}

abstract class ElementFactory
{
    protected Button $button;
    protected Description $description;

    public function __construct()
    {
        $this->button = new Button();
        $this->description = new Description;
    }

    abstract public function getButton(): string;

    abstract public function getDescription(): string;
}

class WindowsFactory extends ElementFactory
{
    public function getButton(): string
    {
        return $this->button->getWindowsButton();
    }

    public function getDescription(): string
    {
        return $this->description->getWindowsDescription();
    }
}

class LinuxFactory extends ElementFactory
{
    public function getButton(): string
    {
        return $this->button->getLinuxButton();
    }

    public function getDescription(): string
    {
        return $this->description->getLinuxDescription();
    }
}

$windowFactory = new WindowsFactory();
$button = $windowFactory->getButton();
var_dump($button);
$description = $windowFactory->getDescription();
var_dump($description);

$linuxFactory = new LinuxFactory();
$button = $linuxFactory->getButton();
var_dump($button);
$description = $linuxFactory->getDescription();
var_dump($description);
