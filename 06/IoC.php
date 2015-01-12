<?php

class IoC
{
    protected static $resolvers = [];

    public static function register($name, $resolver)
    {
        static::$resolvers[$name] = $resolver;
    }

    public static function make($name, $params = [])
    {
        if( isset(static::$resolvers[$name]) )
        {
            $resolver = static::$resolvers[$name];
            // return $resolver();
            return call_user_func_array($resolver, $params);
        }
        throw new Exception("No registered resolver for {$name} in the IoC");
    }
}
