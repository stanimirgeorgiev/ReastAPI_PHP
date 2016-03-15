<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Engine;

/**
 * Description of Dispatcher
 *
 * @author Stanimir Georgiev
 */
class Dispatcher {

    public function __construct() {
        
    }

    public function __call($name, $params) {
        if (!is_callable($this->$name())) {
            throw new Exception("No such method: " . $name, 500);
        }
        $this->$name($params);
    }
    
    public function get($params) {
        if (!is_array($params) || count($params) == 0) {
            throw new Exception("No valid parameters: " . implode(', ', $params), 500);
        }
        
        
    }

}
