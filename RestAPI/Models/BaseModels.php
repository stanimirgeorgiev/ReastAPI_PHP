<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Models;

/**
 * Description of BaseModels
 *
 * @author Stanimir Georgiev
 */
class BaseModels {

    /**
     * @var \DBConnection
     */
    private $DBConnection = null;
    private $isValid = false;
    public function __construct(\DBConnection $DBConnection) {
        
        $this->DBConnection = $DBConnection;
    }
    public function getIsValid() {
        return $this->isValid;
    }

        public function isValid() {
        
    }
    
}
