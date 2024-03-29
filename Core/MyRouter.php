<?php

class MyRouter
{
    protected array $routes =[];

    private $routeExists = false;

    /*
     * Add routes to the $routes
     */

    public function addRoute($method, $url, $controller, $function): void
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
        $uri = trim($uri, '/');

        $valid = false;
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



            $routeAsRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route["url"]) . "$@";

            if (preg_match_all($routeAsRegex, $uri, $valueMatches)) {
                $value = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $value[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $value);
                $this->routeExists = true;


                //echo '<pre>';
                //print_r($valueMatches);
                //echo '</pre>';
                //die();
            }

            $controller = $route["controller"];
            $function = $route["function"];


            if (class_exists($controller) && !empty($valueMatches[0]) && $uri == $valueMatches[0][0]) {

                $controllerInstance = new $controller();

                if (method_exists($controller, $function)) {
                    if(!empty($routeParams)) {
                        $controllerInstance->$function(($routeParams['id']));
                    } else {
                        $controllerInstance->$function();
                    }

                }
                else {
                    echo "Page not found 404";
                }
            }
        }
        if(!$this->routeExists) {
            view('errors/not-found');
        }
    }
}