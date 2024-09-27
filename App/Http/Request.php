<?php

namespace App\Http;

use stdClass;

class Request
{
    private $data;

    public function __construct()
    {

        $this->data = new stdClass();

        foreach (array_merge($_GET, $_POST) as $key => $value) {
            $this->data->$key = $value;
        }
    }


    public function __get($key)
    {
        return $this->data->$key ?? null;
    }


    public function __isset($key)
    {
        return isset($this->data->$key);
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
