<?php
namespace TablePrinter;

class Formatter
{
    protected $headers;
    protected $rows;
    protected $transposedRows;

    public function __construct($headers, $rows = [])
    {
        $this->headers        = $headers;
        $this->rows           = $rows;
        $this->transposedRows = $rows ? $this->transposeRows($rows) : [];
    }

    public function setRows($rows)
    {
        $this->rows = $rows;
        $this->transposedRows = $this->transposeRows($rows);
    }

    public function getDivider($char = '+')
    {
        $sections = array_map(function($width) {
            return str_repeat('-', $width);
        }, $this->getColumnWidths());

        return $char.join($char, $sections).$char."\n";
    }

    public function getPrintMask()
    {
        $columnWidths = $this->getColumnWidths();

        $maskPieces = array_map(function($width) {
            return "%-{$width}s";
        }, $columnWidths);

        return '|'.join('|', $maskPieces).'|';
    }

    public function getColumnWidths()
    {
        $rows = $this->rows;
        array_unshift($rows, $this->headers);

        $columns = $this->transposeRows($rows);

        return array_map(function($column) {
            return max(array_map('strlen', $column)) + 3;
        }, $columns);
    }

    protected function transposeRows($rows)
    {
        array_unshift($rows, null);
        return call_user_func_array('array_map', $rows);
    }
}
