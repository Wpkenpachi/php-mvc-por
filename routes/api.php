<?php

use App\Http\Request\EndpointHandler as Router;
use App\Http\Controllers\ProductController;


Router::get( ProductController::class, 'list');
Router::get(ProductController::class, 'show');
Router::post(ProductController::class, 'store');
