<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Engine\Routers;

/**
 * Description of DefaultRouter
 *
 * @author Stanimir Georgiev
 */
class DefaultRouter implements \RestAPI\Interfaces\RouterInterface {

    public function getURI() {

        $customRoutes = \RestAPI\App::getInstance()->getCustomRoutes();
        $requestRoute = substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME']) + 1);
        $requestAction = $_SERVER['REQUEST_METHOD'];
        if (!is_array($customRoutes[$requestAction]) || !isset($customRoutes[$requestAction]) || count($customRoutes[$requestAction]) == 0) {
            throw new Exception("Custom routes are missconfigured: " . print_r($customRoutes), 500);
        }
        
        $routerCallback = null;
        foreach ($customRoutes as $action => $routes) {
            if ($action != $requestAction) {
                break;
            }
            
            foreach ($routes as $route => $callback) {
                if (!$this->areEqual($route, $requestRoute)) {
                    break;
                }
                
                $routePArams = $this->getRouteParams($route, $requestRoute);
                return $callback;
            }
        }
        
        return $requestRoute;
    }

    public function getPost() {
        
    }

    public function areEqual($route, $request) {
        $routeElemnets = explode('/', $route);
        $requestElements = explode('/', $request);

        if (count($requestElements) != count($routeElemnets)) {
            return false;
        }
        
        $areEqual = false;
        for ($element = 0; $element < count($routeElemnets); $element++) {
            if (!strpos($routeElemnets[$element], ":")) {
                continue;
            }
            
            if ($routeElemnets[$element] != $requestElements[$element]) {
                break;
            } else {
                $areEqual = true;
            }
        }

        return $areEqual;
    }
    
    public function getRouteParams($route, $request) {
        $routeElemnets = explode('/', $route);
        $requestElements = explode('/', $request);
        
        $routeParams = [];
        for ($element = 0; $element < count($routeElemnets); $element++) {
            if (strpos($routeElemnets[$element], ":") != false) {
                continue;
            }
            
        }
    }

}
