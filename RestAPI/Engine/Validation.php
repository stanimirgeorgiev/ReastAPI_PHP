<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace GTFramework;

/**
 * Description of Validation
 *
 * @author Stanimir Georgiev
 */
class Validation {

    public function __construct() {
        
    }
        public function validateToken() {
        if (!isset($_SESSION['afToken'])) {
           return false;
        }
        if ($_POST['AFToken'] !== $_SESSION['afToken']) {
            return false;
        } 
        return true;
    }

}
