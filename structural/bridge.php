<?php

namespace DesignPattern\Structural\Bridge;

interface FileSavable
{
    public function save($content, $savePath);
}

class HtmlSaver implements FileSavable
{
    public function save($content, $savePath)
    {
        var_dump($content);
        var_dump('Content saved to html');
    }
}

class PdfSaver implements FileSavable
{
    public function save($content, $savePath)
    {
        var_dump($content);
        var_dump('Content saved to pdf');
    }
}

abstract class ContentHandler
{
    protected FileSavable $fileSaver;

    public function __construct(FileSavable $fileSaver)
    {
        $this->fileSaver = $fileSaver;
    }

    public function handle($file, $savePath)
    {
        $content = $this->parseData($file);
        $this->fileSaver->save($content, $savePath);
    }

    abstract protected function parseData($file): string;
}

class CsvContentHandler extends ContentHandler
{
    protected function parseData($file): string
    {
        return 'Content from csv';
    }
}

class TxtContentHandler extends ContentHandler
{
    protected function parseData($file): string
    {
        return 'Content from txt';
    }
}

$handler = new CsvContentHandler(new PdfSaver());
$handler->handle('file', 'path');

$handler = new CsvContentHandler(new HtmlSaver());
$handler->handle('file', 'path');

$handler = new TxtContentHandler(new PdfSaver());
$handler->handle('file', 'path');

$handler = new TxtContentHandler(new HtmlSaver());
$handler->handle('file', 'path');
