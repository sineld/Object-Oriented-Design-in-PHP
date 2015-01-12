<?php
namespace Loggr;

class EchoOut
{
    public function log($date, $body)
    {
        echo "{$date} - {$body}\n";
    }
}
