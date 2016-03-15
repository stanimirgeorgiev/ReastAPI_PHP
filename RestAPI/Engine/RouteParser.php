<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Engine;

/**
 * Description of FrontController
 *
 * @author Stanimir Georgiev
 */
class RouteParser {

    private static $_instance = null;
    private $ns = null;
    private $controller = null;
    private $method = null;
    private $bundle = null;
    private $customRoutes = [];
    private $router = null;

    private function __construct() {
    }

    public function getRouter() {
        return $this->router;
    }

    public function setRouter(\RestAPI\Interfaces\RouterInterface $router) {
        $this->router = $router;
    }

    public function processReguest() {
        $_uri = $this->router->getURI();
        if ($this->router == null) {
            throw new \Exception('Router is not set', 500);
        }
        
        $_rc = null;
        

        if (substr($_uri, -1) === '/') {
            $_uri = substr($_uri, 0, -1);
        }
        
        $_params = explode('/', $_uri);
        if (isset($_params[0]) && trim($_params[0])) {
            $this->controller = strtolower($_params[0]);
            unset($_params[0]);
        } else {
            $this->controller = $this->getDefaultControler();
        }
        if (isset($_params[1]) && trim($_params[1])) {
            $this->method = strtolower($_params[1]);
            unset($_params[1]);
        } else {
            $this->method = $this->getDefaultMethod();
        }
        $_params = array_values($_params);
        if ($_rc && is_array($_rc) && isset($_rc[$this->controller]['to'])) {
            $this->controller = strtolower($_rc[$this->controller]['to']);
        }
        if (isset($_rc[$this->controller]['method'][$this->method]) && trim($_rc[$this->controller]['method'][$this->method])) {
            $this->method = strtolower($_rc[$this->controller]['method'][$this->method]);
        }

        $f = $this->ns . '\\' . ucfirst($this->controller);

        $newController = new $f();

        if (method_exists($newController, $this->method)) {
            $newController->{$this->method}($_params);
        } else {
            throw new \Exception('Called nonexistent method: ' . $this->method, 404);
        }
    }

    public function getDefaultControler() {
        if ($this->bundle != null && $this->bundle != '*') {
            if (isset($this->customRoutes[$this->bundle])) {
                if (isset($this->customRoutes[$this->bundle]['default_controller'])) {

                    return strtolower(trim($this->customRoutes[$this->bundle]['default_controller']));
                } else {
                    throw new \Exception('Default controller must be provided in routes for the ' . $this->bundle . ' bundle', 500);
                }
            } else {
                if (isset($this->customRoutes[ucfirst($this->bundle)]['default_controller'])) {

                    return strtolower(trim($this->customRoutes[ucfirst($this->bundle)]['default_controller']));
                } else {
                    throw new \Exception('Default controller must be provided in routes for the ' . $this->bundle . ' bundle', 500);
                }
            }
        }
        $controller = \GTFramework\App::getInstance()->getConfig()->app['default_controller'];
        if (trim($controller)) {
            return strtolower($controller);
        }
        return 'index';
    }

    public function getDefaultMethod() {
        if ($this->bundle != NULL && $this->bundle != '*') {
            if (isset($this->customRoutes[$this->bundle])) {
                if (isset($this->customRoutes[$this->bundle]['default_method'])) {

                    return strtolower(trim($this->customRoutes[$this->bundle]['default_method']));
                } else {
                    throw new \Exception('Default method must be provided in routes for the ' . $this->bundle . ' bundle', 500);
                }
            } else {
                if (isset($this->customRoutes[ucfirst($this->bundle)]['default_method'])) {

                    return strtolower(trim($this->customRoutes[ucfirst($this->bundle)]['default_method']));
                } else {
                    throw new \Exception('Default method must be provided in routes for the ' . $this->bundle . ' bundle', 500);
                }
            }
        }
        $method = \GTFramework\App::getInstance()->getConfig()->app['default_method'];
        if (trim($method)) {
            return strtolower($method);
        }
        return 'index';
    }

    /**
     * 
     * @return \RestAPI\Engine\RouteParser
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new \RestAPI\Engine\RouteParser();
        }
        return self::$_instance;
    }

}
