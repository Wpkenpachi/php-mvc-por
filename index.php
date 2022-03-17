<?php

use App\Http\Request\EndpointHandler;

include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/routes/api.php';


$server = new EndpointHandler();
$server->listen();