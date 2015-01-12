<?php

class Highlander
{
    protected static $instance;


    public static function getInstance()
    {
        if (! static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}

var_dump(Highlander::getInstance());
var_dump(Highlander::getInstance());
