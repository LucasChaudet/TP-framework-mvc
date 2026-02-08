<?php
/** @var Router $router */

use App\Controller\HomeController;
use IIA\Framework\Router\Router;

$router->get("/", HomeController::class, "index");
$router->get("/about", HomeController::class, "about");
