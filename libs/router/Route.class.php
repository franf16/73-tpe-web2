<?php

class Route {

    private $url;
    private $verb;
    private $controller;
    private $method;
    private $params;

    public function __construct($url, $verb, $controller, $method) {
        $this->url = explode('/', trim($url, '/'));
        $this->verb = $verb;
        $this->controller = $controller;
        $this->method = $method;
        $this->params = [];
    }

    public function match($url, $verb): bool {
        if ($this->verb != $verb) {
            return false;
        }
        $url = explode('/', trim($url, '/'));
        if (count($this->url) != count($url)) {
            return false;
        }
        foreach ($this->url as $i => $part) {
            if ($part[0] != ':') {
                if ($part != $url[$i]) {
                    return false;
                }
            }
            else $this->params[$part] = $url[$i];
        }
        return true;
    }

    public function run(): void {
        $controller = $this->controller;
        $method = $this->method;
        $params = $this->params;

        (new $controller())->$method(empty($params) ? null : $params);
    }
}