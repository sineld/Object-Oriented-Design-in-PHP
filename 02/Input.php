<?php


class Input
{

    protected $inputs = array( 'get' => array() , 'post' => array() );


    public function __construct( $inputs = array() )
    {
        $this->replace($inputs);
    }

    public function replace( $inputs = array())
    {
        foreach ($this->inputs as $key => $input)
        {
            if(isset($inputs[$key]))
            {
                $this->inputs[$key] = $inputs[$key];
            }

        }
    }

    public static function createFromGlobals()
    {
        return new static(['get' => $_GET, 'post' => $_POST  ]);
    }


    public function get($key)
    {
        return $this->_fetch('get', $key);
    }


    public function post($key)
    {
        return $this->_fetch('post', $key);
    }

    protected function _fetch($input, $key)
    {
        $result = null;
        if( isset($this->inputs[$input][$key]))
        {
            $result = $this->inputs[$input][$key];
        }
        return $result;
    }
}
