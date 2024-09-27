<?php

namespace Drogo\Response;

class JsonResponse
{
    public static function output(array $response)
    {
        echo json_encode($response);
    }
}
