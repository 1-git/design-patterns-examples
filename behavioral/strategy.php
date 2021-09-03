<?php

namespace DesignPattern\Behavioral\Strategy;

use Exception;

interface OpenFileStrategyInterface
{
    public function getFileContent(): string;
}

class CsvFileOpener implements OpenFileStrategyInterface
{
    public function getFileContent(): string
    {
        //Open csv
        return 'Csv content';
    }
}

class TextFileOpener implements OpenFileStrategyInterface
{
    public function getFileContent(): string
    {
        //Open text
        return 'Txt content';
    }
}

###########################################################
####### SOLUTION 1 - STRATEGY DETECT OUTSIDE OF CLASS #####
###########################################################

class Context1
{
    protected OpenFileStrategyInterface $openFileStrategy;

    public function __construct(OpenFileStrategyInterface $openFileStrategy)
    {
        $this->openFileStrategy = $openFileStrategy;
    }

    public function getInfo(string $filename): string
    {
        return $this->openFileStrategy->getFileContent();
    }
}

$filename = 'one_file.csv';
$context = (new Context1(new CsvFileOpener()))->getInfo($filename);
var_dump($context);

$filename = 'one_file.txt';
$context = (new Context1(new TextFileOpener()))->getInfo($filename);
var_dump($context);

###########################################################
##### SOLUTION 2 - STRATEGY DETECT INSIDE CONTEXT FILE ####
###########################################################

class Context2
{
    protected OpenFileStrategyInterface $openFileStrategy;

    public function getInfo(string $filename): string
    {
        $extension = pathinfo($filename)['extension'];
        if ($extension === 'csv') {
            $fileOpener = new CsvFileOpener();
        } elseif ($extension === 'txt') {
            $fileOpener = new TextFileOpener();
        } else {
            throw new Exception();
        }

        return $fileOpener->getFileContent($filename);
    }
}

$filename = 'one_file.csv';
$context = (new Context2())->getInfo($filename);
var_dump($context);

$filename = 'one_file.txt';
$context = (new Context2())->getInfo($filename);
var_dump($context);

###########################################################
####### SOLUTION 3 - STRATEGY DETECT IN SEPARATE FILE #####
###########################################################

class Context3
{
    public function getInfo(string $filename): string
    {
        $handler = (new OpenerFileRouter())->getHandler($filename);
        return $handler->getFileContent($filename);
    }
}

class OpenerFileRouter
{
    public function getHandler(string $filename): OpenFileStrategyInterface
    {
        $extension = pathinfo($filename)['extension'];
        if ($extension === 'csv') {
            $handler = new CsvFileOpener();
        } elseif ($extension === 'txt') {
            $handler = new TextFileOpener();
        } else {
            throw new Exception();
        }

        return $handler;
    }
}

$filename = 'one_file.csv';
$context = (new Context3())->getInfo($filename);
var_dump($context);

$filename = 'one_file.txt';
$context = (new Context3())->getInfo($filename);
var_dump($context);
