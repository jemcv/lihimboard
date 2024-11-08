<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use App\Router;

$router = new Router();

// Include the routes
require_once __DIR__ . '/../src/routes.php';

// Get the current URI and query parameters
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$queryParams = $_GET;

// Dispatch the request
ob_start(); // Start output buffering
$router->dispatch($uri);
ob_end_flush(); // Flush the output buffer