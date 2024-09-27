<?php

namespace App\Controllers;

use App\Http\Request;
use Drogo\Response\JsonResponse;

class HomeController
{
    public function index(Request $request): JsonResponse
    {
        return JsonResponse::output(['mensage' => $request->name]);
    }
}
