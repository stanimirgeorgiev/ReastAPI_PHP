<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

/**
 * Description of BaseController
 *
 * @author Stanimir Georgiev
 */

namespace RestAPI\Controllers;

class BaseController {

    /**
     * @var \RestAPI\Interfaces\ResponseInterface
     */
    private $response;
    private $writer = null;
    private $DBConnection = null;

    public function __construct($DBConnection, \RestAPI\Interfaces\OutputWriterInterface $writer, \RestAPI\Interfaces\ResponseInterface $response) {

        $this->DBConnection = $DBConnection;
        $this->writer = $writer;
        $this->response = $response;
    }

    public function getWriter() {
        return $this->writer;
    }

    public function getDBConnection() {
        return $this->DBConnection;
    }

    public function setWriter($writer) {
        $this->writer = $writer;
        return $this;
    }

    public function setDBConnection($DBConnection) {
        $this->DBConnection = $DBConnection;
        return $this;
    }

    public function getResponse() {
        return $this->response;
    }

    public function setResponse(\RestAPI\Interfaces\ResponseInterface $response) {
        $this->response = $response;
        return $this;
    }

}
