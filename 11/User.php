<?php

class User
{
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
