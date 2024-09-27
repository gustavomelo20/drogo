<?php

use App\Controllers\HomeController;
use Drogo\Http;

Http::get('/', HomeController::class, 'index');
