<?php

use Drogo\Http;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

require 'App/Routes/api.php';

Http::dispatch();
