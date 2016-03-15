<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

/**
 * Description of BaseExceptionInterface
 *
 * @author Stanimir Georgiev
 */

namespace RestAPI\Interfaces;

interface BaseExceptionInterface {
    public function outputData(\RestAPI\Interfaces\OutputWriterInterface $writer);
}
