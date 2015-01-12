<?php

class ORM
{
    protected static $datastore = [];
    protected $attributes = [];
    protected $queryArgs = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    public static function query()
    {
        return new static();
    }

    public static function find($id)
    {
        if (isset(static::$datastore[$id])) {
            return new static(static::$datastore[$id]);
        }

        throw new Exception(get_called_class()." {$id} not found.");
    }

    public static function all()
    {
        $all = [];

        foreach (static::$datastore as $data) {
            $all[] = new static($data);
        }

        return $all;
    }

    public function where() { return $this; }
    public function skip() { return $this; }
    public function save() { return $this; }

    public function take($num)
    {
        $this->queryArgs['take'] = $num;

        return $this;
    }

    public function get()
    {
        $all = static::all();
        if (isset($this->queryArgs['take'])) {
            return array_slice($all, 0, $this->queryArgs['take']);
        } else {
            return $all;
        }
    }

    public function __get($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
