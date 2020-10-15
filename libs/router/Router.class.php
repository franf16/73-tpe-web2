<?php 

require_once './libs/router/Route.class.php';

class Router {

    private $routeTable;
    private $defaultRoute;

    public function __construct() {
        $this->routeTable = [];
        $this->defaultRoute = null;
    }

    public function route($url, $verb): void {
        foreach ($this->routeTable as $route) {
            if ($route->match($url, $verb)) {
                $route->run();
                return;
            }
        }
        if ($this->defaultRoute) {
            $this->defaultRoute->run();
        }
        else {
            die("404");
        }
    }

    public function addRoute($url, $verb, $controller, $method): void {
        array_push($this->routeTable, new Route($url, $verb, $controller, $method));
    }

    public function setDefaultRoute($controller, $method): void {
        $this->defaultRoute = new Route('', '', $controller, $method);
    }

}