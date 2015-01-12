<?php

require '../TablePrinter.php';

class Printer
{
    public function __construct($formatter)
    {
        $this->formatter = $formatter;
    }

    public function printLine($line)
    {
        return $this->formatter->printLine($line);
    }
}

class HTMLFormatter
{
    public function printLine($line)
    {
        return '<h1>'.$line.'</h1>';
    }
}

class CLIFormatter
{
    public function printLine($line)
    {
        return $line;
    }
}

$tp = new TablePrinter(['Strategy', 'Output']);

$tp->addRow('HTML', (new Printer(new HTMLFormatter()))->printLine('Hello, World!'));
$tp->addRow('CLI', (new Printer(new CLIFormatter()))->printLine('Hello, World!'));

echo $tp->output();
