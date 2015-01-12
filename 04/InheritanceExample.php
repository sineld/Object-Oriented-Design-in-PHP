<?php
// require 'TablePrinet.php';


class Greeting
{
    public function greet($name)
    {
        return 'Hello, ' .$name;
    }
}

class LessFormalGreeting extends Greeting
{
    public function greet($name)
    {
        return 'Sup, ' .$name;
    }
}

class PirateGreeting extends Greeting
{
    public function greet($name)
    {
        return 'Welcome aboard, me matey ' .$name;
    }
}

function greet( Greeting $greeting, $name = 'Someone' )
{
    return $greeting->greet($name);
}

echo "Greeting: " . greet(new Greeting()) . PHP_EOL;
echo "LessFormalGreeting: " . greet(new LessFormalGreeting()) . PHP_EOL;
echo "PirateGreeting: " . greet(new PirateGreeting()) . PHP_EOL;
