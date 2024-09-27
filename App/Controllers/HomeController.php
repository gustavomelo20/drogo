<?php

namespace App\Controllers;

use Drogo\Response\JsonResponse;

class HomeController
{
    public function index()
    {
        return JsonResponse::output(['mensage' => 'Hello Word!']);
    }
}
