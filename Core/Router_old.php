<?php

class Router_old {

    public $routes = [];

    public function add($uri, $controller, $method, $requestMethod)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'requestMethod' => $requestMethod
        ];
    }
    public function get($uri, $controller, $method, $args = [])
    {
        $this->add($uri, $controller, $method, $args,'GET');
    }

    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
    }

    public function patch($uri, $controller)
    {
        $this->add($uri, $controller, 'PATCH');
    }

    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'PUT');
    }

    public function route($uri, $RequestMethod)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['requestMethod'] === strtoupper($RequestMethod)) {
                return require $route['controller'];
            }
        }

        $this->abort();
    }

    private function abort($code = 404): void
    {
        http_response_code($code);
        require 'views/errors/not-found.php';
        die();
    }
}