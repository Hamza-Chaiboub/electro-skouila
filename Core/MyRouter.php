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


        //echo '<pre>';
        //var_dump($this->routes);
        //echo '</pre>';
        //die();

        foreach ($this->routes as $route) {

            $controller = $route["controller"];
            $function = $route["function"];
            if (class_exists($controller) && $uri == $route["url"]) {
                $controllerInstance = new $controller();
                if (method_exists($controller, $function)) {
                    $controllerInstance->$function();
                }
            }
        }
    }
}