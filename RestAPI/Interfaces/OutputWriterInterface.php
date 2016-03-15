<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

/**
 * Description of ExceptionWriterInterface
 *
 * @author Stanimir Georgiev
 */

namespace RestAPI\Interfaces;

interface OutputWriterInterface {
    public function createOutput($data);
}
