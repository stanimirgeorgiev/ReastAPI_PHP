<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI;

include_once 'AutoLoader.php';
include_once 'Router.php';

class App {

    private static $_instance = null;
    private $customRoutes = [];
    private $routeParser = null;

    private function __construct() {
        \RestAPI\AutoLoader::registerNamespace('RestAPI', dirname(__FILE__) . DIRECTORY_SEPARATOR);
        \RestAPI\AutoLoader::registerAutoLoad();
        $this->run();
    }

    public function run() {
        $this->routeParser = \RestAPI\Engine\RouteParser::getInstance();
        $this->routeParser = 
        }
    
    public function getCustomRoutes() {
        return $this->customRoutes;
    }
    
    public function setCustomRoutes($routes) {
        $this->customRoutes = $routes;
    }
    
    /**
     * 
     * @return \RestAPI\App
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new \RestAPI\App();
        }

        return self::$_instance;
    }
}
