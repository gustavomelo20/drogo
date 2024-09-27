<?php

namespace Drogo\Response;

class JsonResponse
{
    private $data;

    public function __construct(array $response)
    {
        $this->data = $response;
    }

    public static function output(array $response): self
    {
        return new self($response);
    }

    public function send()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }
}
