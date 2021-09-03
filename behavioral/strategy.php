<?php

namespace DesignPattern\Behavioral\Strategy;

interface OpenFileStrategyInterface {
    public function getFileContent(): string;
}

class CsvFileOpener implements OpenFileStrategyInterface
{
    public function getFileContent(): string
    {
        //Open csv
        return 'Text';
    }
}

class TextFileOpener implements OpenFileStrategyInterface
{
    public function getFileContent(): string
    {
        //Open text
        return 'Text';
    }
}

class Content{
    protected OpenFileStrategyInterface $openFileStrategy;

    public function __(OpenFileStrategyInterface $openFileStrategy)
    {
        $this->openFileStrategy = $openFileStrategy;
    }

    public function getInfo(): string
    {
        return $this->openFileStrategy->getFileContent();
    }
}

$filename = 'one_file.csv';
$content = new Content(new CsvFileOpener);

$filename = 'one_file.txt';
$content = new Content(new TextFileOpener);
