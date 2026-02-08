<?php

use IIA\Autoloader;
use IIA\Framework\Database\Database;
use IIA\Framework\Router\Router;

require_once "vendor/IIA/Autoloader.php";

Autoloader::addPath("App", __DIR__ . "/src");
Autoloader::register();

require_once __DIR__ . "/config/database.php";
$router = new Router(new Database(DB_NAME, DB_HOST, DB_USER, DB_PASS));

// Définir les routes
require_once __DIR__ . "/config/routes.php";

// Récupération de l'URI et de la méthode HTTP
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$httpMethod = $_SERVER['REQUEST_METHOD'];

// Dispatch
$router->dispatch($uri, $httpMethod);

