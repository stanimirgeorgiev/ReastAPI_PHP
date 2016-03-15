<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Exceptions;

/**
 * Description of RequestException
 *
 * @author Stanimir Georgiev
 */

use \Interfaces;
use \Engine\OutputWriters;

class RequestException extends \Exception implements \BaseExceptionInterface {

    private $message = '';
    private $code = 0;
    private $writer = null;

    public function __construct($message, \ExceptionWriterInterface $writer, $code = 0) {
        parent::__construct($message, $code);
        $this->message = $message;
        $this->code = $code;

        if ($writer === null) {
            $this->writer = new OutputWriters\OutputWriters\JSONWriter();
        } else {
            $this->writer = $writer;
        }
    }

    public function outputMessage() {
        $this->writer($this->message);
    }

    public function outputData(Interfaces\OutputWriterInterface $writer) {
        
    }

}
