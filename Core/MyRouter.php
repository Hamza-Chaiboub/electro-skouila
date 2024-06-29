<?php

namespace Core;
use Controllers\HomeController;

class MyRouter
{
    protected array $routes =[];

    private bool $routeExists = false;

    /*
     * Add routes to the $routes
     */

    public function addRoute($method, $url, $controller, $function): void
    {
        $this->routes[] = [
            "method" => $method,
            "url" => $url,
            "controller" => $controller,
            "function" => $function
        ];
    }

    public function matchRoute($uri, $method = 'OPTIONS'): void
    {
        $uri = trim($uri, '/');

        foreach ($this->routes as $route) {

            $routeNames = [];
            $route["url"] = trim($route["url"], '/');
            if (preg_match_all('/\{(\w+)(:[^}]+)?/', $route["url"], $matches)) {
                $routeNames = $matches[1];
            }

            /*
             *            Conversion:
             * /category/{id} to /category/(\w+)
             */



            $routeAsRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "($m[2])" : '(\w+)', $route["url"]) . "$@";

            if (preg_match_all($routeAsRegex, $uri, $valueMatches)) {
                $value = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $value[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $value);
                $this->routeExists = true;
            }

            $controller = $route["controller"];
            $function = $route["function"];


            if (class_exists($controller) && !empty($valueMatches[0]) && $uri == $valueMatches[0][0] && ($method == $route["method"] || $_SERVER['REQUEST_METHOD'] == 'OPTIONS')) {

                $controllerInstance = new $controller();

                if (method_exists($controller, $function)) {
                    if(!empty($routeParams)) {
                        $controllerInstance->$function(...$routeParams);
                    } else {
                        $controllerInstance->$function();
                    }

                }
                else {
                    //view('errors/404');
                    HomeController::notFound();
                }
            }
        }
        if(!$this->routeExists) {
            //view('errors/404');
            HomeController::notFound();
        }
    }
}