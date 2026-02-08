<?php

namespace IIA\Framework\Router;

class Route
{
    public function __construct(
        private string $path,
        private string $controller,
        private string $method,
        private string $httpMethod = 'GET'
    ) {}

    public function matches(string $uri, string $httpMethod): bool
    {
        return $this->path === $uri && $this->httpMethod === $httpMethod;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}