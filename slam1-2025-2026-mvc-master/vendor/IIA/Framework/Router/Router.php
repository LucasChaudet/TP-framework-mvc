<?php

namespace IIA\Framework\Router;

use IIA\Framework\Controller\Controller;
use IIA\Framework\Database\Database;

class Router
{

    

    /** @var Route[] */
    private array $routes = [];

    public function __construct(
        private Database $database
    ) {}

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    public function get(string $path, string $controller, string $method): void
    {
        $this->addRoute(new Route($path, $controller, $method, 'GET'));
    }

    public function post(string $path, string $controller, string $method): void
    {
        $this->addRoute(new Route($path, $controller, $method, 'POST'));
    }

    private function callController(Route $route): void
    {
        $controllerName = $route->getController();
        $methodName = $route->getMethod();

        if (!class_exists($controllerName)) {
            throw new \Exception("Le contrôleur $controllerName n'existe pas");
        }

        /** @var Controller $controller */
        $controller = new $controllerName();
        $controller->setDatabase($this->database);

        if (!method_exists($controller, $methodName)) {
            throw new \Exception("La méthode $methodName n'existe pas");
        }

        $controller->$methodName();
    }

        public function setNotFoundMessage(string $message): void
    {
        $this->notFoundMessage = $message;
    }


    private string $notFoundMessage = "Page non trouvée";

    public function dispatch(string $uri, string $httpMethod): void
    {
        foreach ($this->routes as $route) {
            if ($route->matches($uri, $httpMethod)) {
                $this->callController($route);
                return;
            }
        }
        // Permet d'afficher un message d'erreur si la page n'est pas trouvée 
        http_response_code(404);
        echo $this->notFoundMessage;
    }
}