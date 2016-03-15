<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Routers;

/**
 * Description of BaseRouter
 *
 * @author Stanimir Georgiev
 */
class BaseRouter implements RouterInterface {

    /**
     * @var \RestAPI\Engine\Dispatcher
     */
    private $dispatcher = null;
    private $request = [];

    public function __construct(\RestAPI\Engine\Dispatcher $dispatcher) {

        $this->dispatcher = $dispatcher;
    }

    //basic arguments ('GET, '/controller/params', function($params) {}
    public function map($action, $route, $callback) {
        $this->request[$action][$route] = $callback;
    }

    public function match() {
        
        foreach ($this->request as $action => $routes) {
            foreach ($routes as $route => $callback) {
                $this->dispatcher->$action($route, $callback);
            }
        }
    }

}
