<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Engine;

/**
 * Description of Kernel
 *
 * @author Stanimir Georgiev
 */
class Kernel {

    private $params = null;
    private $method = null;
    private $class = null;
    private static $_instance = null;

    private function __construct() {
    }

    public function findController($class = null, $method = null, $params = null) {
        $this->class = $class;
        $this->method = $method;
        $this->params = $params;

        if (!class_exists($class)) {
            throw new \Exception('Class: ' . $class . ' non existent', 404);
        }
        if (!method_exists($class, $method)) {
            throw new \Exception('Method: ' . $method . ' non existent', 404);
        }
        
        if (!\RestAPI\Engine\AnnotationValidation::getInstance()->validate($class, $method)) {
            throw new \Exception('Class: ' . $class . 'and Method: ' . $method . 'Invalidated by annotations: ' . \RestAPI\Engine\AnnotationValidation::getInstance()->getAnnotations($param));
        }
        $controller = new $class;
        if ($params !== null) {
            $controller->$method($params);
        }
        $controller->$method();
    }

    public function checkAnotations($class, $method) {
        
    }
    
    public function helper($helperClass, $helperMethod) {

        if (!trim($helperClass) && !trim($helperMethod)) {
            throw new \Exception('Helpers require valid class full name and method name', 500);
        }

        if (!class_exists($helperClass)) {
            throw new \Exception('Class with name: ' . $helperClass . ' doesn\'t exist in namespace', 500);
        }

        $helperObject = new $helperClass;

        if (!method_exists($helperObject, $helperMethod)) {
            throw new \Exception('Method with name: ' . $helperMethod . ' do not exist in class: ' . print_r($helperObject, TRUE), 500);
        }

        return $helperObject->$helperMethod();
    }
    
    /**
     * 
     * @return \GTFramework\Kernel
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new \RestAPI\Kernel();
        }
        return self::$_instance;
    }

}
