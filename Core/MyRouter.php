<?php

class MyRouter
{
    protected $routes =[];

    /*
     * Add routes to the $routes
     */

    public function addRoute($method, $url, $controller, $function)
    {
        //$this->routes["method"] = $method;

        $this->routes[] = [
            "url" => $url,
            "controller" => $controller,
            "function" => $function
        ];
    }

    public function matchRoute($uri)
    {
        //$this->routes["method"] = $_SERVER['REQUEST_METHOD'];
        $routeNames = [];

        foreach ($this->routes as $route) {
            if (preg_match_all('/\{(\w+)(:[^}]+)?/', $route["url"], $matches)) {
                $routeNames = $matches[1];
            }

            echo '<pre>';
            var_dump($routeNames);
            echo '</pre>';

            /*$controller = $route["controller"];
            $function = $route["function"];

            if (class_exists($controller) && $uri == $route["url"]) {
                $controllerInstance = new $controller();
                if (method_exists($controller, $function)) {
                    $controllerInstance->$function();
                }
            }*/
        }
    }
}