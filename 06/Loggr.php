<?php

class Loggr
{
    protected $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function log($string)
    {
        return $this->logger->log($this->getDate(), $string);
    }

    protected function getDate()
    {
        return date('H:i:s');
    }
}
