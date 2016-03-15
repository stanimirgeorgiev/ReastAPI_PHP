<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Sessions;

/**
 * Description of NativeSession
 *
 * @author Stanimir Georgiev
 */
class NativeSession implements \RestAPI\Interfaces\SessionInterface{
    
    public function __construct(
            $name = null,
            $lifetime = 3600,
            $path = null,
            $domain = null,
            $secure = false ,
            $httponly = TRUE
            ) {
        if (strlen($name)<1) {
            $name = '_sess';
        }
        
        session_name($name);
        session_set_cookie_params($lifetime,$path, $domain, $secure, $httponly);
        session_start();
        $_COOKIE['__sess'] = session_id();
    }

    public function __get($name) {
        return $_SESSION[$name];
    }

    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function destroySession() {
        session_destroy();
    }

    public function getSessionId() {
        return session_id();
    }

    public function saveSession() {
        session_write_close();
    }
}

