<?php

require 'TablePrinter/Formatter.php';

class TablePrinter
{
    protected $headers = [];
    protected $rows = [];
    protected $mask = null;
    protected $formatter;

    public function __construct($headers, $formatter = null)
    {
        $this->headers = $headers;
        $this->formatter = $formatter ?: new TablePrinter\Formatter($headers);
    }

    public function addRow(/* variadic */)
    {
        $this->rows[] = func_get_args();
    }

    public function output()
    {
        $this->formatter->setRows($this->rows);

        ob_start();
        $this->printDivider();
        $this->printRow($this->headers);
        $this->printDivider();
        foreach ($this->rows as $row) {
            $this->printRow($row);
        }
        $this->printDivider();
        echo ob_get_clean();
    }

    public function printDivider()
    {
        echo $this->formatter->getDivider();
    }

    protected function printRow($row)
    {
        array_unshift($row, $this->getMask());
        echo call_user_func_array('sprintf', $row)."\n";
    }

    protected function getMask()
    {
        return $this->mask ?: $this->mask = $this->formatter->getPrintMask();
    }
}
