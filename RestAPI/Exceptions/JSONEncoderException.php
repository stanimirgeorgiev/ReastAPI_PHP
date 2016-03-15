<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Exceptions;

/**
 * Description of JSONEncoderException
 *
 * @author Stanimir Georgiev
 */
class JSONEncoderException extends \Exception {
    
    private $message = '';
    private $code = 0;
    private $writer = null;

    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
        $this->message = $message;
        $this->code = $code;
        
        if ($this->writer === null) {
            $this->writer = new JSONWriter($message);
        } else {
            $this->writer = $writer;
        }
    }

    public function outputMessage() {
        $this->writer($this->message);
    }
}
