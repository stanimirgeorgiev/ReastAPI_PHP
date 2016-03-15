<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Engine\OutputWriters;

use RestAPI\Interfaces;

/**
 * Description of JSONWriter
 *
 * @author Stanimir Georgiev
 */
class JSONWriter implements \RestAPI\Interfaces\OutputWriterInterface {

    private $data;

    public function __construct($data) {
        header("Content-Type: application/json");
        $this->data = $data;
    }

    public function createOutput($data) {

        $json = json_encode($data);

        if (!$json) {
            throw new \JSONEncodeException("A problem accurred to encode the given data: " . $data, 500);
        }

        $result = htmlspecialchars($json, ENT_NOQUOTES);

        return $result;
    }

}
