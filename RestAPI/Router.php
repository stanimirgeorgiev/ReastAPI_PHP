<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI;

/**
 * Description of Router
 *
 * @author Stanimir Georgiev
 */
class Router {

    public function __construct() {
        var_dump("izpylnqva se !!!!!!");
    }

    private $routes = [];

    /**
     * 
     * @param string $action
     * @param string $route
     * @param function | array | string $callback User defined action to be 
     *        over the given route
     */
    public function map($action, $route, $callback) {
        $this->routes[$action][$route] = $callback;
    }

    /**
     * 
     * @return string JSON that indicates success/failure of the method,
     *                or JSON that indicates an error occurred.
     */
    public function match() {
        \RestAPI\App::getInstance()->setCustomRoutes($this->routes);
        $customRoutes = \RestAPI\App::getInstance()->getCustomRoutes();

        return $customRoutes;
    }

}
