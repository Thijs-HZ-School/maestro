<?php

require __DIR__ . '/../vendor/autoload.php';

use Framework\Request;
use Framework\Kernel;

// Extract the path from the URL
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!is_string($urlPath)) {
    $urlPath = '/';
}

$kernel = new Kernel();

$router = $kernel->getRouter();

$router->addRoute('GET', '/', 'Home Page');
$router->addRoute('GET', '/about', 'About Page');

$request = new Request($_SERVER['REQUEST_METHOD'], $urlPath, $_GET, $_POST);

$kernel->handle($request)->echo();
