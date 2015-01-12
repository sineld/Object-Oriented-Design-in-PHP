<?php

class User extends ORM
{
    protected static $datastore = [
        1 => [
            'id' => 1,
            'username' => 'machuga',
            'email' => 'machuga@example.com',
            'createdAt' => '2012-12-31 01:00:00'
        ],
        2 => [
            'id' => 2,
            'username' => 'demo',
            'email' => '2014-01-01 01:00:00',
            'createdAt' => '2013-01-11 01:00:00'
        ],
        3 => [
            'id' => 3,
            'username' => 'awesomesauce',
            'email' => 'awesomesauce@example.com',
            'createdAt' => '2013-02-01 01:00:00'
        ]
    ];

    public function __construct($data = [])
    {
        parent::__construct($data);

        if ($this->createdAt) {
            $this->createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $this->createdAt);
        }
    }

    public function createdThisYear()
    {
        $now = new DateTime('now');
        return $this->createdAt->format('Y') == $now->format('Y');
    }
}

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
