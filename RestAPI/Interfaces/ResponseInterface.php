<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Interfaces;

/**
 * Description of RequestInterface
 *
 * @author Stanimir Georgiev
 */
class ResponseInterface {

    public function OK($data, $message);

    public function Created($data, $message);

    public function NotFound($data, $message);

    public function Unauthorized($data, $message);
}
