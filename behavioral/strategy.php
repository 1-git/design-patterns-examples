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

class Content1
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
$content = (new Content1(new CsvFileOpener()))->getInfo($filename);
var_dump($content);

$filename = 'one_file.txt';
$content = (new Content1(new TextFileOpener()))->getInfo($filename);
var_dump($content);

###########################################################
##### SOLUTION 2 - STRATEGY DETECT INSIDE CONTEXT FILE ####
###########################################################

class Content2
{
    protected OpenFileStrategyInterface $openFileStrategy;

    public function getInfo(string $filename): string
    {
        $extension = pathinfo($filename)['extension'];
        if ($extension === 'csv') {
            $fileOpener = new CsvFileOpener();
        } elseif ($extension === 'txt') {
            $fileOpener = new TextFileOpener();
        }

        return $fileOpener->getFileContent($filename);
    }
}

$filename = 'one_file.csv';
$content = (new Content2())->getInfo($filename);
var_dump($content);

$filename = 'one_file.txt';
$content = (new Content2())->getInfo($filename);
var_dump($content);

###########################################################
####### SOLUTION 3 - STRATEGY DETECT IN SEPARATE FILE #####
###########################################################

class Content3
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
$content = (new Content3())->getInfo($filename);
var_dump($content);

$filename = 'one_file.txt';
$content = (new Content3())->getInfo($filename);
var_dump($content);
