<?php
/* 
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI;

final class AutoLoader {

    private static $namespaces = array();

    private function __construct() {
    }

    public static function registerAutoLoad() {
        spl_autoload_register(array('\RestAPI\AutoLoader', 'autoload'));
    }

    public static function autoload($class) {
        self::loadClass($class);
    }

    public static function loadClass($class) {
        if ($class == 'Exception') {
            throw new \Exception('Unhandled exeption has occured and has been passed to autoload.', 500);
        }
        
        $isFound = false;
        foreach (self::$namespaces as $key => $value) {

            if (strpos($class, $key) === 0) {

                $file = realpath(substr_replace(str_replace('\\', DIRECTORY_SEPARATOR, $class), $value, 0, strlen($key)) . '.php');

                if ($file && is_readable($file)) {
                    include $file;
                } else {
                    throw new \Exception('File cannot be included ' . $key . $value, 404);
                }
                
                $isFound = true;
                break;
            }
        }
        
        if (!$isFound) {
            throw new \Exception('Cannot load class ' . $class);
        }
    }

    public static function registerNamespace($namespace, $path) {
        $namespace = trim($namespace);
        if (strlen($namespace) > 0) {
            if (!$path) {
                throw new \Exception('Invalid path');
            }
            
            $_path = realpath($path);
            if ($_path && is_dir($_path) && is_readable($_path)) {
                self::$namespaces[$namespace . '\\'] = $_path . DIRECTORY_SEPARATOR;
            } else {
                throw new Exception('Namespace directory read error ' . $_path);
            }
        } else {
            throw new \Exception('Invalid namespace: ' . $namespace);
        }
    }

    public static function registerNameSpaces($ns) {
        if (is_array($ns)) {
            foreach ($ns as $k => $v) {
                self::registerNamespace($k, $v);
            }
        } else {
            throw new \Exeption('Invalid namespaces array ' . '<pre>' . print_r($ns, TRUE) . '</pre>');
        }
    }
}
